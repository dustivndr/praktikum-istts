abstract class Pokemon implements Pertarungan{

    // Atribut dasar yang dimiliki semua jenis Pokemon.
    protected String nama;
    protected int    hp;

    // Constructor dipakai oleh class turunan untuk mengisi data awal.
    Pokemon(String nama, int hp) {
        this.nama = nama;
        this.hp   = hp;
    }

    // Method biasa: semua child class mewarisi dan bisa langsung memakainya.
    void info() {
        System.out.println("Nama: " + nama + ", HP: " + hp);
    }

    // Mengecek apakah Pokemon sudah kalah.
    public boolean kalah() {
        return hp <= 0;
    }

    // Menerima damage dari lawan.
    public void terimaSerangan(int damage) {
        hp -= damage;
        if (hp < 0) {
            hp = 0;
        }
    }

    // Serangan standar ke lawan: tampilkan aksi lalu kurangi HP target.
    public void serangKe(Pokemon lawan) {
        serang();
        lawan.terimaSerangan(getDamage());
        System.out.println(lawan.nama + " kehilangan " + getDamage() + " HP.");
    }

    // Method abstract: setiap child class wajib membuat versi serang() sendiri.
    public abstract void serang();

    // Nilai damage berbeda untuk setiap jenis Pokemon.
    public abstract int getDamage();
}