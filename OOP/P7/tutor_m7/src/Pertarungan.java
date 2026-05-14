interface Pertarungan {
    void serang(); // Method untuk melakukan serangan.
    void terimaSerangan(int damage); // Method untuk menerima serangan dari lawan.
    int getDamage(); // Method untuk mendapatkan jumlah damage yang diberikan.
    boolean kalah(); // Method untuk mengecek apakah sudah kalah.
}