package jakopec.osc.svastanestooitju;


import android.annotation.TargetApi;
import android.app.Activity;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.MotionEvent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.google.gson.Gson;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URL;


public class PrvaIJedinaAktivnost extends Activity {



    private EditText pb, db;
    private TextView rezultat;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_prva_ijedina_aktivnost);



        pb=(EditText) findViewById(R.id.txtPrviBroj);
        db=(EditText) findViewById(R.id.txtDrugiBroj);
        rezultat=(TextView) findViewById(R.id.lblRezutat);

        final Button button = (Button) findViewById(R.id.btnZbroji);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AsyncTaskRunner runner = new AsyncTaskRunner();
                String[] params = {pb.getText().toString(),db.getText().toString()};
                runner.execute(params);
            }
        });


    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);

    }









    private class AsyncTaskRunner extends AsyncTask<String, String, String> {

        private String resp;

        @Override
        protected String doInBackground(String... params) {
            publishProgress("Radim..."); // Calls onProgressUpdate()

            resp=params.toString();

            /*
            Aplikacija koja se ovdje kontaktira se nalazi u direktoriju PHP_SvastaNestoOITu
             */
            String putanja = "http://web.ffos.hr/oziz/svastanestooit/zbroji.php?tko=android&pbroj=" + params[0] + "&dbroj=" + params[1];

            try {
                String json = readUrl(putanja);
                Log.d("putanja",putanja);
                Gson gson = new Gson();
                Podaci podaci = gson.fromJson(json, Podaci.class);

                return String.valueOf(podaci.getRezultat());

            }catch (Exception e){
                return e.getMessage();
            }




        }

        /*
         * (non-Javadoc)
         *
         * @see android.os.AsyncTask#onPostExecute(java.lang.Object)
         */
        @Override
        protected void onPostExecute(String result) {
            // execution of result of Long time consuming operation
            rezultat.setText(result);
        }

        /*
         * (non-Javadoc)
         *
         * @see android.os.AsyncTask#onPreExecute()
         */
        @Override
        protected void onPreExecute() {
            // Things to be done before execution of long running operation. For
            // example showing ProgessDialog
        }

        /*
         * (non-Javadoc)
         *
         * @see android.os.AsyncTask#onProgressUpdate(Progress[])
         */
        @Override
        protected void onProgressUpdate(String... text) {
            rezultat.setText(text[0]);
            // Things to be done while execution of long running operation is in
            // progress. For example updating ProgessDialog
        }
    }


    private static String readUrl(String urlString) throws Exception {
        BufferedReader reader = null;
        try {
            URL url = new URL(urlString);
            reader = new BufferedReader(new InputStreamReader(url.openStream()));
            StringBuffer buffer = new StringBuffer();
            int read;
            char[] chars = new char[1024];
            while ((read = reader.read(chars)) != -1)
                buffer.append(chars, 0, read);

            return buffer.toString();
        } finally {
            if (reader != null)
                reader.close();
        }
    }


}
