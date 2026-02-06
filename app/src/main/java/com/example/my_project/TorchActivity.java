package com.example.my_project;

import android.hardware.camera2.CameraManager;
import android.os.Bundle;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class TorchActivity extends AppCompatActivity {

    Button btnOn, btnOff, btnBack;
    CameraManager manager;
    String camId;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_torch);

        btnOn = findViewById(R.id.btnOn);
        btnOff = findViewById(R.id.btnOff);
        btnBack = findViewById(R.id.btnBack);

        manager = (CameraManager)
                getSystemService(CAMERA_SERVICE);

        try {
            camId = manager.getCameraIdList()[0];
        } catch (Exception e) {}

        btnOn.setOnClickListener(v -> {
            try {
                manager.setTorchMode(camId, true);
            } catch (Exception e) {}
        });

        btnOff.setOnClickListener(v -> {
            try {
                manager.setTorchMode(camId, false);
            } catch (Exception e) {}
        });

        btnBack.setOnClickListener(v -> finish());
    }
}
