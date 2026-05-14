
public class Hero {

    private final String name, role;
    private final int hp, attack, speed, stars, price;
    private final String attackType, trait;

    private final Skill skill;

    public Hero(String name, String role, int hp, int attack, int speed, String attackType, String trait, Skill skill, int stars, int price) {
        this.name = name;
        this.role = role;
        this.hp = hp;
        this.attack = attack;
        this.speed = speed;
        this.attackType = attackType;
        this.trait = trait;
        this.skill = skill;
        this.stars = stars;
        this.price = price;
    }

    public String getName() {
        return name;
    }

    public String getRole() {
        return role;
    }

    public int getHp() {
        return hp;
    }

    public int getAttack() {
        return attack;
    }

    public int getSpeed() {
        return speed;
    }

    public String getAttackType() {
        return attackType;
    }

    public String getTrait() {
        return trait;
    }

    public int getStars() {
        return stars;
    }

    public int getPrice() {
        return price;
    }

    public Hero copy() {
        return new Hero(name, role, hp, attack, speed, attackType, trait, skill, stars, price);
    }

    @Override
    public String toString() {
        return name + " (" + role + ") - HP:" + hp + " ATK:" + attack + " SPD:" + speed + " Trait:" + trait + " [" + stars + "*]";
    }

    public Skill getSkill() {
        return skill;
    }

}
