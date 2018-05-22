package com.example.user.grocerywatchapp;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.widget.EditText;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import java.net.URLEncoder;

/**
 * Created by Dulitha on 2/1/2018.
 */

public class BackgroundTask extends AsyncTask<String,Void,String> {

    String register_url = "https://smartstorage.000webhostapp.com/loginapp/register.php";
    String login_url = "https://smartstorage.000webhostapp.com/loginapp/login.php";
    Context ctx;
    ProgressDialog progressDialog;
    Activity activity;
    AlertDialog.Builder builder;

    public BackgroundTask(Context ctx)
    {
        this.ctx = ctx;
        activity = (Activity) ctx;
    }

    @Override
    protected void onPreExecute() {
        builder = new AlertDialog.Builder(activity); //initializing the AlertDialog Builder
        progressDialog = new ProgressDialog(ctx); //Initializing progress dialog variable
        progressDialog.setTitle("Please wait!");
        progressDialog.setMessage("Connecting to server...");
        progressDialog.setIndeterminate(true);
        progressDialog.setCancelable(false);
        progressDialog.show();

    }

    @Override
    protected String doInBackground(String... params) {
        String method = params[0];

        if (method.equals("register")){
            try {
                URL url = new URL(register_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream,"UTF-8"));
                String name = params[1];
                String email = params[2];
                String pass = params[3];

                String data = URLEncoder.encode("name", "UTF-8")+"="+URLEncoder.encode(name,"UTF-8")+"&"+
                        URLEncoder.encode("email", "UTF-8")+"="+URLEncoder.encode(email,"UTF-8")+"&"+
                        URLEncoder.encode("pass", "UTF-8")+"="+URLEncoder.encode(pass,"UTF-8");
                bufferedWriter.write(data); //Writing the data using bufferedWriter
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();

                //Checking data whether the insertion is success or not
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                //Read the respond from the bufferedReader
                StringBuilder stringBuilder = new StringBuilder();
                String line = "";
                //using a while loop to read each line from bufferedReader
                while((line=bufferedReader.readLine())!=null)
                {
                    stringBuilder.append(line+"\n"); //append each of these line into stringBuilder
                }
                httpURLConnection.disconnect();

                Thread.sleep(5000);//for a slight pause in doInBackground method

                return stringBuilder.toString().trim(); //returning the string builder




            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }

        else if (method.equals("login"))
        {
            try {
                URL url = new URL(login_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream,"UTF-8"));

                String productid, pass;

                productid = params[1];
                pass = params[2];

                String data = URLEncoder.encode("productid", "UTF-8")+"="+URLEncoder.encode(productid,"UTF-8")+"&"+
                        URLEncoder.encode("pass", "UTF-8")+"="+URLEncoder.encode(pass,"UTF-8");

                bufferedWriter.write(data); //Writing the data using bufferedWriter
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();

                //Checking data whether the insertion is success or not
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                //Read the respond from the bufferedReader
                StringBuilder stringBuilder = new StringBuilder();
                String line = "";
                //using a while loop to read each line from bufferedReader
                while((line=bufferedReader.readLine())!=null)
                {
                    stringBuilder.append(line+"\n"); //append each of these line into stringBuilder
                }
                httpURLConnection.disconnect();

                Thread.sleep(5000);//for a slight pause in doInBackground method

                return stringBuilder.toString().trim(); //returning the string builder


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            } catch (ProtocolException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }

        }

        return null;
    }

    @Override
    protected void onProgressUpdate(Void... values) {

        super.onProgressUpdate(values);
    }

    @Override
    protected void onPostExecute(String json) {

        try {
            progressDialog.dismiss();
            JSONObject jsonObject = new JSONObject(json.substring(json.indexOf("{"), json.lastIndexOf("}") + 1)); //json array contains some "{", so we have to remove it
            JSONArray jsonArray = jsonObject.getJSONArray("server_response"); //array name is server_response
            JSONObject JO = jsonArray.getJSONObject(0);
            String code = JO.getString("code");
            String message = JO.getString("message");

            if (code.equals("reg_true"))
            {
                showDialog("Registration Success", message,code);
            }
            else if(code.equals("reg_false"))
            {
                showDialog("Registration Failed", message,code);
            }

            else if (code.equals("login_true")) //if the login details are correct
            {
                Intent intent = new Intent(activity,HomeActivity.class);
                intent.putExtra("message",message);
                activity.startActivity(intent); //This will start the home activity
            }
            else if (code.equals("login_false"))//if the login details are wrong
            {
                showDialog("Login Failed", message,code);

            }



        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public void showDialog(String title, String message, String code)
    {
        builder.setTitle(title);
        if (code.equals("reg_true")||code.equals("reg_false"))
        {
            builder.setMessage(message);
            builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {
                    dialogInterface.dismiss();
                    activity.finish();
                }
            });

            AlertDialog alertDialog = builder.create();
            alertDialog.show(); //display the alert dialog
        }
        else if (code.equals("login_false"))
        {
            builder.setMessage("message");
            builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {

                    EditText email, password;
                    email = (EditText)activity.findViewById(R.id.editemail);
                    password = (EditText)activity.findViewById(R.id.editpassword);

                    //Resetting the email and password fields empty
                    email.setText("");
                    password.setText("");
                    dialogInterface.dismiss();

                }
            });

        }
        AlertDialog alertDialog = builder.create();
        alertDialog.show(); //display the alert dialog

    }
}

