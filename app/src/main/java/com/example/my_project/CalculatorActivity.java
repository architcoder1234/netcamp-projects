package com.example.my_project;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class CalculatorActivity extends AppCompatActivity {

    EditText etNum1, etNum2;
    TextView txtResult;
    Button btnAdd, btnSub, btnMul, btnDiv, btnClear;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_calculator);

        // Link XML
        etNum1 = findViewById(R.id.etNum1);
        etNum2 = findViewById(R.id.etNum2);
        txtResult = findViewById(R.id.txtResult);

        btnAdd = findViewById(R.id.btnAdd);
        btnSub = findViewById(R.id.btnSub);
        btnMul = findViewById(R.id.btnMul);
        btnDiv = findViewById(R.id.btnDiv);
        btnClear = findViewById(R.id.btnClear);

        // ADD
        btnAdd.setOnClickListener(v -> calculate('+'));

        // SUBTRACT
        btnSub.setOnClickListener(v -> calculate('-'));

        // MULTIPLY
        btnMul.setOnClickListener(v -> calculate('*'));

        // DIVIDE
        btnDiv.setOnClickListener(v -> calculate('/'));

        // CLEAR
        btnClear.setOnClickListener(v -> {
            etNum1.setText("");
            etNum2.setText("");
            txtResult.setText("Result:");
        });
    }

    private void calculate(char operator) {

        // Validation
        if (TextUtils.isEmpty(etNum1.getText()) ||
                TextUtils.isEmpty(etNum2.getText())) {

            Toast.makeText(this,
                    "Please enter both numbers",
                    Toast.LENGTH_SHORT).show();
            return;
        }

        double num1 = Double.parseDouble(etNum1.getText().toString());
        double num2 = Double.parseDouble(etNum2.getText().toString());
        double result;

        switch (operator) {
            case '+':
                result = num1 + num2;
                break;

            case '-':
                result = num1 - num2;
                break;

            case '*':
                result = num1 * num2;
                break;

            case '/':
                if (num2 == 0) {
                    Toast.makeText(this,
                            "Cannot divide by zero",
                            Toast.LENGTH_SHORT).show();
                    return;
                }
                result = num1 / num2;
                break;

            default:
                return;
        }

        txtResult.setText("Result: " + result);
    }
}
