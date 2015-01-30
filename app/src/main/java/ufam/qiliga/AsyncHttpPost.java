package ufam.qiliga;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.StatusLine;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;

public class AsyncHttpPost extends AsyncTask<String, String, String> {
	private HashMap<String, String> mData = null;// post data
	private Activity act;
    private int code_forPost;

    /**
     * constructor
     */
    public AsyncHttpPost(int code_forPost, Activity act, HashMap<String, String> data) {
        this.code_forPost = code_forPost;
        mData = data;
        this.act = act;
    }



    /**
     * background
     */
    @Override
    protected String doInBackground(String... params) {
        byte[] result = null;
        String str = "";
        HttpClient client = new DefaultHttpClient();
        HttpPost post = new HttpPost(params[0]);// in this case, params[0] is URL
        Log.i("doInBckg", "It's my URL: " + params[0]);
        try {
            // set up post data
            ArrayList<NameValuePair> nameValuePair = new ArrayList<NameValuePair>();
            Iterator<String> it = mData.keySet().iterator();
            while (it.hasNext()) {
                String key = it.next();
                nameValuePair.add(new BasicNameValuePair(key, mData.get(key)));
            }

            post.setEntity(new UrlEncodedFormEntity(nameValuePair, "UTF-8"));
            HttpResponse response = client.execute(post);
            StatusLine statusLine = response.getStatusLine();
            if(statusLine.getStatusCode() == HttpURLConnection.HTTP_OK){
                result = EntityUtils.toByteArray(response.getEntity());
                str = new String(result, "UTF-8");
                Log.i("AsyncHttpPost", "This is your result: " + str);
            }
        }
        catch (UnsupportedEncodingException e) {
        	Log.i("UnsupportedEE", "Error httpClient");
            e.printStackTrace();
        }
        catch (Exception e) {
        	Log.i("GeneralExcp", "Error-Exception httpClient");
        	e.printStackTrace();
        }
        return str;
    }
    
    @Override
    public void onPostExecute(String result){
    	Log.i("onPostExecute", result);
        if(this.code_forPost == 0){
    	    if(result.length() == 1) {
                Intent intt = new Intent(act, MapActivity.class);
                intt.putExtra("id", result);
                act.startActivity(intt);
            }else if (result.equals("false")) {
                Toast.makeText(act, "Usuário, ou senha inválida.", Toast.LENGTH_SHORT).show();
        }
		}else if(this.code_forPost == 1){
            Log.i("onPostExecute-MapA", "Markers loaded.");
		}else if(this.code_forPost == 2){
            Log.i("OnPostExecute-MapA", "Occurrence created");
        }else if(this.code_forPost == 3){
            Log.i("OnPostExecute-MapA", "Post created, that's my result: " + result);
        }
    }
}
