class Charizard extends Pokemon {

    Charizard() {
        // Data Charizard diisi lewat constructor parent.
        super("Charizard", 360);
    }

    // Override method abstract dari Pokemon.
    public void serang() {
        System.out.println(nama + " menyerang dengan Flamethrower!");
    }

    public int getDamage() {
        return 30;
    }
}