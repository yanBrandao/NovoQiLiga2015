package ufam.qiliga;

import android.app.Activity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import java.util.HashMap;

public class MainActivity extends Activity{
	
	EditText loginRES, senhaRES;
	Button login;
	AsyncHttpPost asyncHttpPost;


	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		Log.i("Login-OnCreate", "OnCreate iniciado com sucesso.");
	}

	public void onClickLogin(View v){
		loginRES = (EditText) findViewById(R.id.loginEmail_ET);
		senhaRES = (EditText) findViewById(R.id.loginPass_ET);
		login = (Button) findViewById(R.id.loginGo_BT);
		Log.i("Login-OnClick", "That's my click. :D");

		String email = loginRES.getText().toString();
		String senha = senhaRES.getText().toString();

		if (email.equalsIgnoreCase("")) {
			loginRES.setError("Preencha o campo e-mail.");
			loginRES.requestFocus();

		} else if (senha.equalsIgnoreCase("")) {
			senhaRES.setError("Preencha o campo senha.");
			senhaRES.requestFocus();

		} else {
			HashMap<String, String> data = new HashMap<String, String>();
			data.put("login", email);
			data.put("senha", senha);
			asyncHttpPost = new AsyncHttpPost(0, this, data);
			asyncHttpPost.execute(IPConnection.ulr_qiliga + "/server-login.php");
			Log.i("LoginActivity", "AsycnTask Called.");
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
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
}
