package com.example.my_project;

import android.content.Intent;
import android.os.Bundle;
import android.provider.Settings;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class WifiActivity extends AppCompatActivity {

    Button btnOn, btnOff;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_wifi);

        btnOn = findViewById(R.id.btnOn);
        btnOff = findViewById(R.id.btnOff);

        btnOn.setOnClickListener(v ->
                startActivity(
                        new Intent(Settings.ACTION_WIFI_SETTINGS)));

        btnOff.setOnClickListener(v ->
                startActivity(
                        new Intent(Settings.ACTION_WIFI_SETTINGS)));
    }
}
