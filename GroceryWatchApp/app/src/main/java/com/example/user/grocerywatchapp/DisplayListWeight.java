package com.example.user.grocerywatchapp;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class DisplayListWeight extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_display_list_weight);
        WeightListBackgroundTask weightListBackgroundTask = new WeightListBackgroundTask(DisplayListWeight.this);
        weightListBackgroundTask.execute();


    }
}
