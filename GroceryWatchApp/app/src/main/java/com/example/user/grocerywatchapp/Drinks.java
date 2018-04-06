package com.example.user.grocerywatchapp;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class Drinks extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_drinks);

        ListBackgroundTask listBackgroundTask = new ListBackgroundTask(Drinks.this);
        listBackgroundTask.execute();
    }
}
