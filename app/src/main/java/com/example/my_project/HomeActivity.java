package com.example.my_project;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class HomeActivity extends AppCompatActivity {

    TextView txtWelcome;
    Button btnCalculator, btnMusic, btnCamera, btnTools, btnLogout;

    FirebaseAuth mAuth;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        // Firebase
        mAuth = FirebaseAuth.getInstance();
        FirebaseUser user = mAuth.getCurrentUser();

        // Safety check
        if (user == null) {
            startActivity(new Intent(this, LoginActivity.class));
            finish();
            return;
        }

        // Link XML
        txtWelcome = findViewById(R.id.txtWelcome);
        btnCalculator = findViewById(R.id.btnCalculator);
        btnMusic = findViewById(R.id.btnMusic);
        btnCamera = findViewById(R.id.btnCamera);
        btnTools = findViewById(R.id.btnTools);
        btnLogout = findViewById(R.id.btnLogout);

        txtWelcome.setText("Welcome\n" + user.getEmail());

        // Calculator
        btnCalculator.setOnClickListener(v ->
                startActivity(new Intent(HomeActivity.this, CalculatorActivity.class)));

        // Music Player
        btnMusic.setOnClickListener(v ->
                startActivity(new Intent(HomeActivity.this, MusicPlayerActivity.class)));

        // Camera
        btnCamera.setOnClickListener(v ->
                startActivity(new Intent(HomeActivity.this, CameraActivity.class)));

        // Sensors & Tools
        btnTools.setOnClickListener(v ->
                startActivity(new Intent(HomeActivity.this, ToolsActivity.class)));

        // Logout
        btnLogout.setOnClickListener(v -> {
            mAuth.signOut();
            startActivity(new Intent(HomeActivity.this, LoginActivity.class));
            finish();
        });
    }
}
