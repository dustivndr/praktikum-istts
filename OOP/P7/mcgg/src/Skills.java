
public class Skills {

    private static final class SimpleSkill implements Skill {

        private final String name;
        // private final String effect;
        private final int trigger;

        SimpleSkill(String name, int trigger) {
            this.name = name;
            this.trigger = trigger;
        }

        @Override
        public String getName() {
            return name;
        }

        // @Override
        // public String getEffect() {
        //     return effect;
        // }

        @Override
        public int getTrigger() {
            return trigger;
        }
    }

    public static final Skill AKAI = new SimpleSkill("Stomp", 3);
    public static final Skill TIGREAL = new SimpleSkill("Taunt", 4);
    public static final Skill LAYLA = new SimpleSkill("Double Shot", 3);
    public static final Skill MIYA = new SimpleSkill("Rapid Attack", 2);
    public static final Skill EUDORA = new SimpleSkill("Lightning Burst", 3);
    public static final Skill SABER = new SimpleSkill("Backstab", 3);
    public static final Skill KARINA = new SimpleSkill("Shadow Kill", 3);
    public static final Skill RAFAELA = new SimpleSkill("Heal", 2);

    private Skills() {
    }
}
