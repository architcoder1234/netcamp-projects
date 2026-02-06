package com.example.my_project;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class ToolsActivity extends AppCompatActivity {

    Button btnLight, btnTorch, btnWifi, btnBluetooth, btnBack;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tools);

        btnLight = findViewById(R.id.btnLight);
        btnTorch = findViewById(R.id.btnTorch);
        btnWifi = findViewById(R.id.btnWifi);
        btnBluetooth = findViewById(R.id.btnBluetooth);
        btnBack = findViewById(R.id.btnBack);

        btnLight.setOnClickListener(v ->
                startActivity(new Intent(this, LightSensorActivity.class)));

        btnTorch.setOnClickListener(v ->
                startActivity(new Intent(this, TorchActivity.class)));

        btnWifi.setOnClickListener(v ->
                startActivity(new Intent(this, WifiActivity.class)));

        btnBluetooth.setOnClickListener(v ->
                startActivity(new Intent(this, BluetoothActivity.class)));

        btnBack.setOnClickListener(v -> finish());
    }
}
