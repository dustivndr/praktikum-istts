class Pikachu extends Pokemon {

    Pikachu() {
        // Data Pikachu diisi lewat constructor parent.
        super("Pikachu", 274);
    }

    // Override method abstract dari Pokemon.
    public void serang() {
        System.out.println(nama + " menyerang dengan Thunderbolt!");
    }

    public int getDamage() {
        return 25;
    }
}