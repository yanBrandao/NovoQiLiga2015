package ufam.qiliga;


import android.app.Activity;
import android.app.AlertDialog;
import android.app.Application;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Camera;
import android.location.Location;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.concurrent.ExecutionException;

public class MapActivity extends Activity {

    /**
     * Attr for current time *
     */
    String data[];
    int hora;

    /**
     * Attr for model of post and occurrence *
     */
    ArrayList<Poste> postList = new ArrayList<Poste>();

    /**
     * AsyncTask for Http connection *
     */
    AsyncHttpPost asyncHttpPost;

    /**
     * Maps Attr *
     */
    AsyncTask<LatLng, Void, String> geoCodOcorr;
    private GoogleMap map;
    LatLng markerPosition;
    LatLng locationMarker;
    ArrayList<LatLng> markersList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);

        /** Get id from Login **/
        Intent intt = getIntent();
        final String id = intt.getStringExtra("id");

        /** Instantiation of current time **/
        SimpleDateFormat dateFormat_hora = new SimpleDateFormat("HH:mm:ss");
        Calendar cal = Calendar.getInstance();
        Date data_atual = cal.getTime();
        String hora_atual = dateFormat_hora.format(data_atual);
        data = hora_atual.split(":");
        hora = Integer.valueOf(data[0]);

        /** Memory allocation of lists and LatLng **/
        postList = new ArrayList<Poste>();
        markersList = new ArrayList<LatLng>();
        markerPosition = new LatLng(0, 0);

        /**Instantiation of GoogleMap, and setting style of map. **/
        map = ((MapFragment) getFragmentManager().findFragmentById(R.id.map)).getMap();
        map.setMapType(GoogleMap.MAP_TYPE_NORMAL);
        map.setMyLocationEnabled(true);
        map.moveCamera(CameraUpdateFactory.newLatLngZoom(
                new LatLng(-3.0423600673675537, -59.983619689941406), 19));

        /** Connection with webservice to get post and set markers **/
        HashMap<String, String> data = new HashMap<String, String>();
        asyncHttpPost = new AsyncHttpPost(1, this, data);
        try {
            String post_result = asyncHttpPost.execute(IPConnection.ulr_qiliga + "/server-json.php").get();
            degeneratePostJSON(post_result);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }

        /** This onMapClickListener is for create our simulation Post. **/
        /*map.setOnMapClickListener(new GoogleMap.OnMapClickListener() {
            @Override
            public void onMapClick(LatLng latLng) {
                Log.i("onMapClick", "Clicked");
                markerPosition = latLng;
                markersList.add(markerPosition);
                AsyncTask<LatLng, Void, String> geoCod = new ReverseGeocoding(getBaseContext()).execute(
                        markersList.get(
                                markersList.size() - 1));
                try {
                    map.addMarker(new MarkerOptions()
                            .icon(BitmapDescriptorFactory.fromResource(R.drawable.light_offhd))
                            .position(markersList.get(markersList.size() - 1))
                            .title(geoCod.get()));
                    HashMap<String, String> data = new HashMap<String, String>();
                    data.put("latitude", String.valueOf(latLng.latitude));
                    data.put("longitude", String.valueOf(latLng.longitude));
                    asyncHttpPost = new AsyncHttpPost(3, getParent(), data);
                    String post_result = asyncHttpPost.execute(IPConnection.ulr_qiliga + "/server-create_post.php").get();
                    Toast.makeText(getApplicationContext(), post_result, Toast.LENGTH_SHORT).show();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                } catch (ExecutionException e) {
                    e.printStackTrace();
                }
            }
        });*/
        /** Code for onMarkerClick **/
        map.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
            public boolean onMarkerClick(Marker marker) {
                locationMarker = marker.getPosition();
                showMessageConfirm(getParent(), id, locationMarker);
                return false;
            }


        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.map, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void degeneratePostJSON(String data) throws JSONException {
        /** This function extract all information of JSON from server
         * First, post and markers are loaded into respective array
         * The markers will be add. to Map, but this is a huge process.
         * So we implement this in a RunnableThread.
         */

        /** Liberating Memory of lists and LatLng **/
        postList.clear();
        markersList.clear();
        map.clear();

        final JSONObject jo = new JSONObject(data);
        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {

                JSONArray ja;

                int i, k, tam;
                try {
                    ja = jo.getJSONArray("postes");
                    Log.i("run-dgnJSON", "Size of list: " + ja.length());
                    for (i = 0, tam = ja.length(); i < tam; i++) {
                        Poste p = new Poste();
                        p.setId(ja.getJSONObject(i).getInt("idPoste"));
                        p.setLatitude(Float.valueOf(ja.getJSONObject(i).getString("latitude")));
                        p.setLongitude(Float.valueOf(ja.getJSONObject(i).getString("longitude")));
                        p.setStatusDia(ja.getJSONObject(i).getString("statusDia"));
                        p.setStatusNoite(ja.getJSONObject(i).getString("statusNoite"));

                        postList.add(p);
                    }
                    ArrayList<String> geoCOD = new ArrayList<String>();
                    int tamListMarker = postList.size();
                    for (k = 0; k < tamListMarker; k++) {
                        markerPosition = new LatLng(postList.get(k).getLatitude(), postList.get(k).getLongitude());
                        AsyncTask<LatLng, Void, String> geoCod = new ReverseGeocoding(getBaseContext()).execute(markerPosition);
                        Log.i("run-dJSON", "Marker " + geoCod.get() + " added.");
                        if (!geoCOD.contains(geoCod.get())) {
                            geoCOD.add(geoCod.get());
                            markersList.add(markerPosition);
                        }
                    }

                    for (k = 0; k < markersList.size(); k++) {
                        if (hora >= 6 && hora <= 17) {
                            Log.i("run-dJSON", "Day Time: " + hora + " - Current Status Post: " + postList.get(k).getStatusDia());
                            if ("OFF".equals(postList.get(k).getStatusDia())) {
                                map.addMarker(new MarkerOptions()
                                        .icon(BitmapDescriptorFactory.fromResource(R.drawable.light_offhd))
                                        .position(markersList.get(k))
                                        .title(geoCOD.get(k)));
                            } else {
                                map.addMarker(new MarkerOptions()
                                        .icon(BitmapDescriptorFactory.fromResource(R.drawable.light_onhd))
                                        .position(markersList.get(k))
                                        .title(geoCOD.get(k)));

                            }
                        } else {
                            Log.i("run-dJSON", "Night Time: " + hora + " - Current Status Post: " + postList.get(k).getStatusDia());
                            if ("OFF".equals(postList.get(k).getStatusNoite())) {
                                map.addMarker(new MarkerOptions()
                                        .icon(BitmapDescriptorFactory.fromResource(R.drawable.light_offhd))
                                        .position(markersList.get(k))
                                        .title(geoCOD.get(k)));
                            } else {
                                map.addMarker(new MarkerOptions()
                                        .icon(BitmapDescriptorFactory.fromResource(R.drawable.light_onhd))
                                        .position(markersList.get(k))
                                        .title(geoCOD.get(k)));

                            }
                        }
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                } catch (ExecutionException e) {
                    e.printStackTrace();
                }
            }
        });
    }

    public void showMessageConfirm(final Activity act, final String idUsuario, final LatLng positionMarker) {

        AlertDialog.Builder builder = new AlertDialog.Builder(this);

        builder.setTitle("Ocorrência");
        builder.setMessage("Você quer mesmo fazer está ocorrência?");
        builder.setCancelable(false);

        builder.setPositiveButton("Sim", new DialogInterface.OnClickListener() {

            public void onClick(DialogInterface dialog, int which) {
                SimpleDateFormat dateFormat = new SimpleDateFormat("dd-MM-yyyy-HH:mm:ss");
                Calendar cal = Calendar.getInstance();
                Date data_atual = cal.getTime();
                String data_completa = dateFormat.format(data_atual);

                String latitude = String.valueOf(positionMarker.latitude);
                String longitude = String.valueOf(positionMarker.longitude);
                String nNotificacoes = "1";
                String status = "Baixo";
                String situacao = "Não resolvido";
                geoCodOcorr = new ReverseGeocoding(getBaseContext()).execute(positionMarker);
                String ruaPoste = null;
                try {
                    ruaPoste = geoCodOcorr.get();
                    HashMap<String, String> data = new HashMap<String, String>();
                    data.put("idUsuario", idUsuario);
                    data.put("latitude", latitude);
                    data.put("longitude", longitude);
                    data.put("nNotificacoes", nNotificacoes);
                    data.put("status", status);
                    data.put("situacao", situacao);
                    data.put("ruaPoste", ruaPoste);
                    data.put("data", data_completa);

                    asyncHttpPost = new AsyncHttpPost(2, act, data);
                    String answer = asyncHttpPost.execute(IPConnection.ulr_qiliga + "/server-ocorrencia.php").get();
                    Toast.makeText(getApplication(), answer, Toast.LENGTH_LONG). show();
                    Log.i("onClick-Marker", "That's is my result: " + answer);
                    /** Connection with webservice to get post and set markers, again. **/
                    data = new HashMap<String, String>();
                    asyncHttpPost = new AsyncHttpPost(1, act, data);
                    String post_result = asyncHttpPost.execute(IPConnection.ulr_qiliga + "/server-json.php").get();
                    degeneratePostJSON(post_result);
                } catch (InterruptedException e) {
                    e.printStackTrace();
                } catch (ExecutionException e) {
                    e.printStackTrace();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        });

        builder.setNegativeButton("Não", new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });
        AlertDialog alert = builder.create();
        alert.show();
    }

}
