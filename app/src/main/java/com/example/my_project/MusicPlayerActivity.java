package com.example.my_project;

import android.media.MediaPlayer;
import android.os.Bundle;
import android.os.Handler;
import android.widget.Button;
import android.widget.SeekBar;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class MusicPlayerActivity extends AppCompatActivity {

    TextView txtSongName, txtCurrentTime, txtDuration;
    SeekBar seekBar;
    Button btnPlay, btnPause, btnNext, btnPrev;

    MediaPlayer mediaPlayer;
    Handler handler = new Handler();

    // 🎶 OFFLINE PLAYLIST
    int[] songs = {
            R.raw.song1,
            R.raw.song2,
            R.raw.song3
    };

    String[] songNames = {
            "Song One",
            "Song Two",
            "Song Three"
    };

    int currentIndex = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_music_player);

        // Link UI
        txtSongName = findViewById(R.id.txtSongName);
        txtCurrentTime = findViewById(R.id.txtCurrentTime);
        txtDuration = findViewById(R.id.txtDuration);
        seekBar = findViewById(R.id.seekBar);

        btnPlay = findViewById(R.id.btnPlay);
        btnPause = findViewById(R.id.btnPause);
        btnNext = findViewById(R.id.btnNext);
        btnPrev = findViewById(R.id.btnPrev);

        loadSong(currentIndex);

        btnPlay.setOnClickListener(v -> {
            if (!mediaPlayer.isPlaying()) {
                mediaPlayer.start();
                updateSeekBar();
            }
        });

        btnPause.setOnClickListener(v -> {
            if (mediaPlayer.isPlaying()) {
                mediaPlayer.pause();
            }
        });

        btnNext.setOnClickListener(v -> {
            currentIndex = (currentIndex + 1) % songs.length;
            loadSong(currentIndex);
        });

        btnPrev.setOnClickListener(v -> {
            currentIndex = (currentIndex - 1 + songs.length) % songs.length;
            loadSong(currentIndex);
        });

        // SeekBar drag support
        seekBar.setOnSeekBarChangeListener(new SeekBar.OnSeekBarChangeListener() {
            @Override
            public void onProgressChanged(SeekBar seekBar, int progress, boolean fromUser) {
                if (fromUser && mediaPlayer != null) {
                    mediaPlayer.seekTo(progress);
                }
            }

            @Override public void onStartTrackingTouch(SeekBar seekBar) {}
            @Override public void onStopTrackingTouch(SeekBar seekBar) {}
        });
    }

    // 🔄 Load song
    private void loadSong(int index) {
        if (mediaPlayer != null) {
            mediaPlayer.release();
        }

        mediaPlayer = MediaPlayer.create(this, songs[index]);
        txtSongName.setText(songNames[index]);

        seekBar.setMax(mediaPlayer.getDuration());
        txtDuration.setText(formatTime(mediaPlayer.getDuration()));

        mediaPlayer.start();
        updateSeekBar();
    }

    // ⏱ Update progress
    private void updateSeekBar() {
        seekBar.setProgress(mediaPlayer.getCurrentPosition());
        txtCurrentTime.setText(formatTime(mediaPlayer.getCurrentPosition()));

        if (mediaPlayer.isPlaying()) {
            handler.postDelayed(this::updateSeekBar, 1000);
        }
    }

    // 🕒 Format time
    private String formatTime(int millis) {
        int minutes = (millis / 1000) / 60;
        int seconds = (millis / 1000) % 60;
        return String.format("%02d:%02d", minutes, seconds);
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        handler.removeCallbacksAndMessages(null);
        if (mediaPlayer != null) {
            mediaPlayer.release();
        }
    }
}
