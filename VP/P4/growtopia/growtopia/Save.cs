using System;
using System.Drawing;
using System.IO;
using System.Windows.Forms;
using System.Xml;

namespace growtopia
{
    public static class Save
    {
        public static void SaveWorld(string worldName, Panel[,] tileGrid, int rows, int cols)
        {
            try
            {
                string filePath = $"{worldName.ToUpper()}.xml";
                XmlDocument doc = new XmlDocument();

                // Root element <World>
                XmlElement root = doc.CreateElement("World");
                doc.AppendChild(root);

                // World Name Metadata
                XmlElement nameNode = doc.CreateElement("Name");
                nameNode.InnerText = worldName.ToUpper();
                root.AppendChild(nameNode);

                // Dimensions
                XmlElement rowsNode = doc.CreateElement("Rows");
                rowsNode.InnerText = rows.ToString();
                root.AppendChild(rowsNode);

                XmlElement colsNode = doc.CreateElement("Cols");
                colsNode.InnerText = cols.ToString();
                root.AppendChild(colsNode);

                // <Tiles> Container
                XmlElement tilesContainer = doc.CreateElement("Tiles");
                root.AppendChild(tilesContainer);

                for (int r = 0; r < rows; r++)
                {
                    for (int c = 0; c < cols; c++)
                    {
                        XmlElement tileNode = doc.CreateElement("Tile");

                        XmlElement xNode = doc.CreateElement("X");
                        xNode.InnerText = c.ToString();
                        tileNode.AppendChild(xNode);

                        XmlElement yNode = doc.CreateElement("Y");
                        yNode.InnerText = r.ToString();
                        tileNode.AppendChild(yNode);

                        XmlElement typeNode = doc.CreateElement("Type");
                        typeNode.InnerText = GetTileTypeFromColor(tileGrid[r, c].BackColor);
                        tileNode.AppendChild(typeNode);

                        tilesContainer.AppendChild(tileNode);
                    }
                }

                doc.Save(filePath);
                MessageBox.Show($"World '{worldName.ToUpper()}' saved successfully!", "World Saved");
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Failed to save world: {ex.Message}", "Save Error");
            }
        }

        public static bool LoadWorld(string worldName, Panel[,] tileGrid, int rows, int cols, int[,] tileHealth, bool[,] isWorldGeneratedDirt)
        {
            string filePath = $"{worldName.ToUpper()}.xml";

            if (!File.Exists(filePath)) return false;

            try
            {
                XmlDocument doc = new XmlDocument();
                doc.Load(filePath);

                XmlNodeList tileNodes = doc.SelectNodes("//Tile");

                foreach (XmlNode tileNode in tileNodes)
                {
                    int x = int.Parse(tileNode["X"].InnerText);
                    int y = int.Parse(tileNode["Y"].InnerText);
                    string type = tileNode["Type"].InnerText;

                    if (y < rows && x < cols)
                    {
                        tileGrid[y, x].BackColor = GetColorFromTileType(type);

                        if (type == "Dirt")
                        {
                            tileHealth[y, x] = 3;
                            isWorldGeneratedDirt[y, x] = true;
                        }
                        else if (type == "Rock")
                        {
                            tileHealth[y, x] = 4;
                            isWorldGeneratedDirt[y, x] = false;
                        }
                        else if (type == "Lava")
                        {
                            tileHealth[y, x] = 1;
                            isWorldGeneratedDirt[y, x] = false;
                        }
                        else if (type == "CaveBG")
                        {
                            tileHealth[y, x] = 3;
                            isWorldGeneratedDirt[y, x] = false;
                        }
                        else if (type == "Bedrock")
                        {
                            tileHealth[y, x] = 999;
                            isWorldGeneratedDirt[y, x] = false;
                        }
                        else // Sky or undefined
                        {
                            tileHealth[y, x] = 0;
                            isWorldGeneratedDirt[y, x] = false;
                        }
                    }
                }
                return true;
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error reading world save: {ex.Message}", "Load Error");
                return false;
            }
        }

        private static string GetTileTypeFromColor(Color color)
        {
            if (color == Color.LightSkyBlue) return "Sky";
            if (color == Color.SaddleBrown) return "Dirt";
            if (color == Color.DimGray) return "Rock";
            if (color == Color.Red) return "Lava";
            if (color == Color.DarkSlateGray) return "CaveBG";
            return "Bedrock";
        }

        private static Color GetColorFromTileType(string type)
        {
            switch (type)
            {
                case "Sky": return Color.LightSkyBlue;
                case "Dirt": return Color.SaddleBrown;
                case "Rock": return Color.DimGray;
                case "Lava": return Color.Red;
                case "CaveBG": return Color.DarkSlateGray;
                case "Bedrock": return Color.FromArgb(50, 50, 50);
                default: return Color.LightSkyBlue;
            }
        }
    }
}