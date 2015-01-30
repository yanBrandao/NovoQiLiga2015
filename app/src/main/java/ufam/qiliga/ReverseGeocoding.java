package ufam.qiliga;

import android.content.Context;
import android.location.Address;
import android.location.Geocoder;
import android.os.AsyncTask;

import com.google.android.gms.maps.model.LatLng;

import java.io.IOException;
import java.util.List;

/**
 * Created by yanbrandao on 11/29/14.
 */
public class ReverseGeocoding extends AsyncTask<LatLng, Void, String> {

    Context mContext;

    public ReverseGeocoding(Context context){
        super();
        mContext = context;
    }

    // Finding address using reverse geocoding
    @Override
    protected String doInBackground(LatLng... params) {
        Geocoder geocoder = new Geocoder(mContext);
        double latitude = params[0].latitude;
        double longitude = params[0].longitude;

        List<Address> addresses = null;
        String addressText="";
        try {
            addresses = geocoder.getFromLocation(latitude, longitude,1);
        } catch (IOException e) {
            e.printStackTrace();
        }
        if(addresses != null && addresses.size() > 0 ){
            Address address = addresses.get(0);

            addressText = //String.format("%s, %s, %s",
                    address.getMaxAddressLineIndex() > 0 ? address.getAddressLine(0) : "";
        }
        return addressText;
    }
}
