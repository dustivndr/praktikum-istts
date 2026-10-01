using System;
using System.Collections.Generic;
using System.Drawing;
using System.Windows.Forms;

namespace PianoTiles
{
    public partial class Form1 : Form
    {
        private const int TileSpeed = 5;
        private const int TileHeight = 52;
        private const int SpawnInterval = 1500;
        private const int GameTickInterval = 20;
        private const int MaxTiles = 4;

        private readonly Random random = new();
        private readonly List<Button> tiles = new();
        private readonly System.Windows.Forms.Timer gameTimer = new();
        private readonly System.Windows.Forms.Timer spawnTimer = new();
        private readonly System.Windows.Forms.Timer flashTimer = new();

        private Button? flashButton;
        private int score;

        public Form1()
        {
            InitializeComponent();

            DoubleBuffered = true;
            KeyPreview = true;

            button5.TabStop = false;
            UpdateScore();

            KeyDown += Form1_KeyDown;

            gameTimer.Interval = GameTickInterval;
            gameTimer.Tick += GameTimer_Tick;
            gameTimer.Start();

            spawnTimer.Interval = SpawnInterval;
            spawnTimer.Tick += SpawnTimer_Tick;
            spawnTimer.Start();

            flashTimer.Interval = 120;
            flashTimer.Tick += FlashTimer_Tick;
        }

        private void SpawnTimer_Tick(object? sender, EventArgs e)
        {
            if (tiles.Count >= MaxTiles)
            {
                return;
            }

            Button laneButton = GetLaneButton(random.Next(0, 4));
            int tileWidth = Math.Max(20, laneButton.Width - 6);

            Button tile = new Button
            {
                BackColor = Color.Black,
                FlatStyle = FlatStyle.Flat,
                Location = new Point(laneButton.Left + ((laneButton.Width - tileWidth) / 2), -TileHeight),
                Size = new Size(tileWidth, TileHeight),
                TabStop = false,
                Text = string.Empty
            };
            tile.FlatAppearance.BorderColor = Color.DimGray;
            tile.FlatAppearance.BorderSize = 1;

            Controls.Add(tile);
            tile.BringToFront();
            tiles.Add(tile);
        }

        private void GameTimer_Tick(object? sender, EventArgs e)
        {
            for (int i = tiles.Count - 1; i >= 0; i--)
            {
                Button tile = tiles[i];

                if (tile.IsDisposed)
                {
                    tiles.RemoveAt(i);
                    continue;
                }

                tile.Top += TileSpeed;

                if (tile.Top > ClientSize.Height)
                {
                    RemoveTile(tile);
                }
            }
        }

        private void Form1_KeyDown(object? sender, KeyEventArgs e)
        {
            int laneIndex = e.KeyCode switch
            {
                Keys.D => 0,
                Keys.F => 1,
                Keys.J => 2,
                Keys.K => 3,
                _ => -1
            };

            if (laneIndex < 0)
            {
                return;
            }

            Button laneButton = GetLaneButton(laneIndex);

            e.Handled = true;
            e.SuppressKeyPress = true;
            FlashLaneButton(laneButton);
            TryHitTile(laneIndex);
        }

        private void TryHitTile(int laneIndex)
        {
            Button laneButton = GetLaneButton(laneIndex);
            Button? hitTile = null;
            int hitScore = 0;

            for (int i = 0; i < tiles.Count; i++)
            {
                Button tile = tiles[i];
                int currentScore = GetTileScore(tile, laneButton);

                if (currentScore <= hitScore)
                {
                    continue;
                }

                hitTile = tile;
                hitScore = currentScore;
            }

            if (hitTile is null || hitScore == 0)
            {
                return;
            }

            tiles.Remove(hitTile);
            score += hitScore;
            UpdateScore();
            RemoveTile(hitTile);
        }

        private int GetTileScore(Button tile, Button laneButton)
        {
            int overlapTop = Math.Max(tile.Top, laneButton.Top);
            int overlapBottom = Math.Min(tile.Bottom, laneButton.Bottom);
            int overlapHeight = overlapBottom - overlapTop;

            if (overlapHeight >= tile.Height)
            {
                return 200;
            }

            if (overlapHeight >= tile.Height / 2)
            {
                return 100;
            }

            return 0;
        }

        private void FlashLaneButton(Button laneButton)
        {
            if (flashButton is not null && flashButton != laneButton && !flashButton.IsDisposed)
            {
                flashButton.BackColor = SystemColors.ActiveCaption;
            }

            if (laneButton.IsDisposed)
            {
                return;
            }

            flashButton = laneButton;
            laneButton.BackColor = Color.SandyBrown;
            flashTimer.Stop();
            flashTimer.Start();
        }

        private void FlashTimer_Tick(object? sender, EventArgs e)
        {
            flashTimer.Stop();

            if (flashButton is null || flashButton.IsDisposed)
            {
                return;
            }

            flashButton.BackColor = SystemColors.ActiveCaption;
            flashButton = null;
        }

        private void RemoveTile(Button tile)
        {
            tiles.Remove(tile);

            if (tile.IsDisposed)
            {
                return;
            }

            Controls.Remove(tile);
            tile.Dispose();
        }

        private Button GetLaneButton(int laneIndex)
        {
            return laneIndex switch
            {
                0 => button1,
                1 => button2,
                2 => button3,
                3 => button4,
                _ => throw new ArgumentOutOfRangeException(nameof(laneIndex))
            };
        }

        private void UpdateScore()
        {
            button5.Text = $"Score: {score}";
        }
    }
}
