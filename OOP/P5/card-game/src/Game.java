
import cards.*;
import java.util.ArrayList;
import java.util.Random;

public class Game {

    private static final String[] ELEMENTS = { "Fire", "Water", "Flora", "Light", "Dark" };
    private static final Random random = new Random();

    private static Player player1;
    private static Player player2;

    public static void game() {

        player1 = playerCardSelect(1);
        System.out.println();
        player2 = playerCardSelect(2);

        startBattle();

    }

    public static Player playerCardSelect(int player) {

        while (true) {

            System.out.println("Choose 3 Cards for Player " + player);
            System.out.println("1. Pyro Maniac - Fire");
            System.out.println("2. Atlantic Siren - Water");
            System.out.println("3. Stone Golem - Flora");
            System.out.println("4. Holy Paladin - Light");
            System.out.println("5. Grim Reaper - Dark");
            System.out.print(">> ");
            String cardSelect = App.scanner.nextLine();

            if (!cardSelect.contains(",")) {
                System.out.println("Invalid input");
                continue;
            }

            String[] parts = cardSelect.split(",");

            if (parts.length != 3) {
                System.out.println("You must choose 3 cards. No more, no less.\n");
                continue;
            }

            int[] numbers = new int[3];
             boolean validFormat = true;

            for (int i = 0; i < 3; i++) {
                String part = parts[i].trim();

                if (part.length() != 1 || !Character.isDigit(part.charAt(0))) {
                     validFormat = false;
                    break;
                }

                int num = part.charAt(0) - '0';

                if (num < 1 || num > 5) {
                    System.out.println("Invalid card choice(s). Please choose card numbers between 1 and 5.\n");
                     validFormat = false;
                    break;
                }

                numbers[i] = num;
            }

             if (!validFormat) {
                 System.out.println("Invalid input format. Use exactly 3 numbers, separated by commas (example: 1,3,5).");
                 continue;
             }

            if (numbers[0] == numbers[1] ||
                    numbers[0] == numbers[2] ||
                    numbers[1] == numbers[2]) {
                System.out.println("There are duplicate card choices.\n");
                continue;
            }

            Card[] selectedCards = new Card[3];
            for (int i = 0; i < numbers.length; i++) {
                selectedCards[i] = createCard(numbers[i]);
            }

            Card activeCard = chooseActiveCard(player, selectedCards);
            Player selectedPlayer = new Player(player, selectedCards, activeCard);

            System.out.println("Valid input accepted!\n");
            return selectedPlayer;

        }

    } // close player card selector

    public static Card chooseActiveCard(int player, Card[] selectedCards) {

        while (true) {
            System.out.println();
            System.out.println("Player " + player + ", choose your active card:");

            for (int i = 0; i < selectedCards.length; i++) {
                System.out.print((i + 1) + ". ");
                selectedCards[i].cardNameInfo();
                System.out.println();
            }

            System.out.print(">> ");
            String activeChoice = App.scanner.nextLine().trim();

            if (activeChoice.length() != 1 || !Character.isDigit(activeChoice.charAt(0))) {
                System.out.println("Invalid input");
                continue;
            }

            int activeIndex = activeChoice.charAt(0) - '1';
            if (activeIndex < 0 || activeIndex >= selectedCards.length) {
                System.out.println("Invalid active card choice.\n");
                continue;
            }

            return selectedCards[activeIndex];
        }

    } // close ps chooseActiveCard

    public static Card createCard(int cardNumber) {
        return switch (cardNumber) {
            case 1 -> new PyroManiac();
            case 2 -> new AtlanticSiren();
            case 3 -> new StoneGolem();
            case 4 -> new HolyPaladin();
            case 5 -> new GrimReaper();
            default -> throw null;
        };
    }

    private static void startBattle() {

        int round = 1;
        int currentTurn = 1;
        int firstEndRoundTurn = 0;
        boolean player1EndedRound = false;
        boolean player2EndedRound = false;

        while (true) {
            Player currentPlayer = currentTurn == 1 ? player1 : player2;
            Player enemyPlayer = currentTurn == 1 ? player2 : player1;

            if (!ensureBattleCanContinue(currentPlayer, enemyPlayer)) {
                return;
            }

            int[] dicePool = rollDice(currentPlayer.getActiveCard().getCardElement());

            while (true) {
                System.out.println();
                printBattleScreen(round, currentPlayer, enemyPlayer, dicePool);

                System.out.print(">> ");
                String action = App.scanner.nextLine().trim();
                boolean endTurn = false;

                switch (action) {
                    case "1" -> {
                        Card[] cards = currentPlayer.getSelectedCards();
                        Card active = currentPlayer.getActiveCard();

                        while (true) {
                            System.out.println("Choose a new active card:");
                            for (int i = 0; i < cards.length; i++) {
                                String marker = cards[i] == active ? " <active>" : "";
                                if (cards[i].getCardHP() <= 0) {
                                    marker += " <KO>";
                                }
                                System.out.println((i + 1) + ". " + cards[i].getCardName() + marker);
                            }
                            System.out.print(">> ");
                            String sel = App.scanner.nextLine().trim();
                            if (sel.length() != 1 || !Character.isDigit(sel.charAt(0))) {
                                System.out.println("Invalid input");
                                continue;
                            }
                            int idx = sel.charAt(0) - '1';
                            if (idx < 0 || idx >= cards.length) {
                                System.out.println("Invalid choice.");
                                continue;
                            }
                            if (cards[idx] == active) {
                                System.out.println("This is the current active card. Choose again");
                                continue;
                            }
                            if (cards[idx].getCardHP() <= 0) {
                                System.out.println("This card has 0 HP and cannot be used.");
                                continue;
                            }

                            while (true) {
                                System.out.println("Choose which dice to consume:");
                                for (int i = 0; i < ELEMENTS.length; i++) {
                                    System.out.println("[" + (i + 1) + "] " + ELEMENTS[i] + " (" + dicePool[i] + ")");
                                }
                                System.out.print(">> ");
                                String dsel = App.scanner.nextLine().trim();
                                if (dsel.length() != 1 || !Character.isDigit(dsel.charAt(0))) {
                                    System.out.println("Invalid input");
                                    continue;
                                }
                                int didx = dsel.charAt(0) - '1';
                                if (didx < 0 || didx >= ELEMENTS.length) {
                                    System.out.println("Invalid dice choice.");
                                    continue;
                                }
                                if (dicePool[didx] <= 0) {
                                    System.out.println("No dice of that element left. Choose again.");
                                    continue;
                                }
                                dicePool[didx]--;
                                break;
                            }

                            currentPlayer.setActiveCard(cards[idx]);
                            System.out.println("Successfully switch to " + cards[idx].getCardName());
                            break;
                        }

                        if (!ensureBattleCanContinue(currentPlayer, enemyPlayer)) {
                            return;
                        }
                    }
                    case "2" -> {
                        int activeElementIndex = getElementIndex(currentPlayer.getActiveCard().getCardElement());

                        if (dicePool[activeElementIndex] <= 0) {
                            System.out.println("You don't have any dice matching the active card's element (" + currentPlayer.getActiveCard().getCardElement() + ").");
                        } else {
                            dicePool[activeElementIndex]--;

                            int diceUsed = 0;
                            while (diceUsed < 2) {
                                System.out.println("Choose 2 dice with any element:");
                                int visibleIndex = 1;
                                for (int i = 0; i < ELEMENTS.length; i++) {
                                    if (dicePool[i] > 0) {
                                        System.out.println("[" + visibleIndex + "] " + ELEMENTS[i] + " (" + dicePool[i] + ")");
                                        visibleIndex++;
                                    }
                                }

                                int selectedDiceCount = 0;
                                for (int i = 0; i < ELEMENTS.length; i++) {
                                    if (dicePool[i] > 0) {
                                        selectedDiceCount++;
                                    }
                                }

                                if (selectedDiceCount == 0) {
                                    System.out.println("No dice left to choose.");
                                    break;
                                }
                                System.out.print(">> ");
                                String dsel = App.scanner.nextLine().trim();
                                if (dsel.length() != 1 || !Character.isDigit(dsel.charAt(0))) {
                                    System.out.println("Invalid input");
                                    continue;
                                }

                                int selectedIndex = dsel.charAt(0) - '1';
                                int didx = -1;
                                int currentVisibleIndex = 0;
                                for (int i = 0; i < ELEMENTS.length; i++) {
                                    if (dicePool[i] > 0) {
                                        currentVisibleIndex++;
                                        if (currentVisibleIndex == selectedIndex + 1) {
                                            didx = i;
                                            break;
                                        }
                                    }
                                }

                                if (didx < 0) {
                                    System.out.println("Invalid dice choice.");
                                    continue;
                                }

                                if (dicePool[didx] <= 0) {
                                    System.out.println("No dice of that element left. Choose again.");
                                    continue;
                                }

                                dicePool[didx]--;
                                diceUsed++;
                            }

                            enemyPlayer.getActiveCard().setCardHP(enemyPlayer.getActiveCard().getCardHP() - 2);
                            currentPlayer.getActiveCard().setCardSkillPoint(currentPlayer.getActiveCard().getCardSkillPoint() + 1);
                            System.out.println("Enemy active card took 2 damage.");

                            if (!ensureBattleCanContinue(currentPlayer, enemyPlayer)) {
                                return;
                            }
                        }
                    }
                    case "3" -> {
                        handleSkillAction(currentPlayer, enemyPlayer, dicePool);
                        if (!ensureBattleCanContinue(currentPlayer, enemyPlayer)) {
                            return;
                        }
                    }
                    case "4" -> {
                        endTurn = true;
                        if (currentTurn == 1) {
                            player1EndedRound = true;
                        } else {
                            player2EndedRound = true;
                        }
                        if (firstEndRoundTurn == 0) {
                            firstEndRoundTurn = currentTurn;
                        }
                    }
                    case "22" -> {
                        currentPlayer.getActiveCard().setCardSkillPoint(currentPlayer.getActiveCard().getCardSkillPoint() + 5);
                        System.out.println("Cheat used: +5 Skill Point for " + currentPlayer.getActiveCard().getCardName() + ".");
                    }
                    case "11" -> {
                        Card[] cards = currentPlayer.getSelectedCards();
                        while (true) {
                            System.out.println("Choose one of your cards to set HP to 0:");
                            for (int i = 0; i < cards.length; i++) {
                                if (cards[i].getCardHP() > 0) {
                                    System.out.println((i + 1) + ". " + cards[i].getCardName() + " (HP " + cards[i].getCardHP() + ")");
                                }
                            }
                            System.out.print(">> ");
                            String sel = App.scanner.nextLine().trim();
                            if (sel.length() != 1 || !Character.isDigit(sel.charAt(0))) {
                                System.out.println("Invalid input");
                                continue;
                            }

                            int idx = sel.charAt(0) - '1';
                            if (idx < 0 || idx >= cards.length) {
                                System.out.println("Invalid choice.");
                                continue;
                            }
                            if (cards[idx].getCardHP() <= 0) {
                                System.out.println("That card already has 0 HP. Choose again.");
                                continue;
                            }

                            cards[idx].setCardHP(0);
                            System.out.println("Cheat used: " + cards[idx].getCardName() + " HP set to 0.");
                            if (!ensureBattleCanContinue(currentPlayer, enemyPlayer)) {
                                return;
                            }
                            break;
                        }
                    }
                    case "99" -> {
                        System.out.println("Cheat used: game ended.");
                        return;
                    }
                    default -> System.out.println("Invalid action. Choose 1, 2, 3, or 4.");
                }

                if (endTurn) {
                    break;
                }

                System.out.println();
            }

            if (player1EndedRound && player2EndedRound) {
                round++;
                currentTurn = firstEndRoundTurn == 0 ? 1 : firstEndRoundTurn;
                player1EndedRound = false;
                player2EndedRound = false;
                firstEndRoundTurn = 0;
            } else {
                currentTurn = currentTurn == 1 ? 2 : 1;
            }
            System.out.println();
        }

    } // close psv startBattle

    private static int[] rollDice(String activeElement) {
        int[] dicePool = new int[ELEMENTS.length];
        int activeElementIndex = getElementIndex(activeElement);

        dicePool[activeElementIndex] += 4;

        for (int i = 0; i < 6; i++) {
            int randomElementIndex = random.nextInt(ELEMENTS.length);
            dicePool[randomElementIndex]++;
        }

        return dicePool;
    }

    private static void printBattleScreen(int round, Player currentPlayer, Player enemyPlayer, int[] dicePool) {
        System.out.println("====================");
        System.out.println("      Round " + round);
        System.out.println("====================");

        printTopPlayerSection(enemyPlayer);
        System.out.println();
        printBottomPlayerSection(currentPlayer);

        System.out.println("====================");
        System.out.println("Turn: Player " + currentPlayer.getPlayerNumber());
        System.out.println("Dice Left: 10");
        for (int i = 0; i < ELEMENTS.length; i++) {
            int count = dicePool[i];
            if (count > 0) {
                System.out.println("- " + count + " " + ELEMENTS[i]);
            }
        }
        System.out.println("====================");
        System.out.println("[1] Switch [2] Attack");
        System.out.println("[3] Skill  [4] End Round");
    }

    private static int getElementIndex(String element) {
        for (int i = 0; i < ELEMENTS.length; i++) {
            if (ELEMENTS[i].equals(element)) {
                return i;
            }
        }
        throw null;
    }

    private static void handleSkillAction(Player currentPlayer, Player enemyPlayer, int[] dicePool) {
        Card activeCard = currentPlayer.getActiveCard();
        int activeElementIndex = getElementIndex(activeCard.getCardElement());
        int requiredSkillPoint = getRequiredSkillPoint(activeCard.getCardName());

        if (activeCard.getCardSkillPoint() < requiredSkillPoint || dicePool[activeElementIndex] < 2) {
            System.out.println("Not enough Skill Points to use the skill.");
            return;
        }

        switch (activeCard.getCardName()) {
            case "Pyro Maniac" -> {
                dicePool[activeElementIndex] -= 2;
                activeCard.setCardSkillPoint(activeCard.getCardSkillPoint() - requiredSkillPoint);
                enemyPlayer.getActiveCard().setCardHP(enemyPlayer.getActiveCard().getCardHP() - 3);
                System.out.println(activeCard.getCardName() + " used its skill!");
                System.out.println("Enemy active card took 3 damage.");
            }
            case "Atlantic Siren" -> {
                dicePool[activeElementIndex] -= 2;
                activeCard.setCardSkillPoint(activeCard.getCardSkillPoint() - requiredSkillPoint);
                for (Card card : enemyPlayer.getSelectedCards()) {
                    card.setCardHP(card.getCardHP() - 2);
                }
                activeCard.setCardHP(activeCard.getCardHP() - 3);
                System.out.println(activeCard.getCardName() + " used its skill!");
                System.out.println("All enemy cards took 2 damage.");
                System.out.println("Atlantic Siren took 3 damage.");
            }
            case "Stone Golem" -> {
                Card[] enemyCards = enemyPlayer.getSelectedCards();
                ArrayList<Card> eligibleCards = new ArrayList<>();

                for (Card card : enemyCards) {
                    if (card.getCardHP() > 0 && card != enemyPlayer.getActiveCard()) {
                        eligibleCards.add(card);
                    }
                }

                if (eligibleCards.isEmpty()) {
                    System.out.println("No eligible enemy card to switch to.");
                    return;
                }

                dicePool[activeElementIndex] -= 2;
                activeCard.setCardSkillPoint(activeCard.getCardSkillPoint() - requiredSkillPoint);

                Card chosenCard = eligibleCards.get(random.nextInt(eligibleCards.size()));
                enemyPlayer.setActiveCard(chosenCard);
                System.out.println(activeCard.getCardName() + " used its skill!");
                System.out.println("Enemy active card switched to " + chosenCard.getCardName() + ".");
            }
            case "Holy Paladin" -> {
                dicePool[activeElementIndex] -= 2;
                activeCard.setCardSkillPoint(activeCard.getCardSkillPoint() - requiredSkillPoint);
                Card[] alliedCards = currentPlayer.getSelectedCards();
                Card lowestCard = alliedCards[0];

                for (Card card : alliedCards) {
                    if (card.getCardHP() < lowestCard.getCardHP()) {
                        lowestCard = card;
                    }
                }

                lowestCard.setCardHP(lowestCard.getCardHP() + 5);
                System.out.println(activeCard.getCardName() + " used its skill!");
                System.out.println(lowestCard.getCardName() + " healed by 5.");
            }
            case "Grim Reaper" -> {
                Card[] enemyCards = enemyPlayer.getSelectedCards();
                ArrayList<Integer> eligibleIndices = new ArrayList<>();

                for (int i = 0; i < enemyCards.length; i++) {
                    if (enemyCards[i].getCardHP() > 0 && enemyCards[i].getCardHP() <= 5) {
                        eligibleIndices.add(i);
                    }
                }

                if (eligibleIndices.isEmpty()) {
                    System.out.println("No enemy card has HP 5 or below.");
                    return;
                }

                dicePool[activeElementIndex] -= 2;
                activeCard.setCardSkillPoint(activeCard.getCardSkillPoint() - requiredSkillPoint);

                int targetIndex;
                while (true) {
                    System.out.println("Choose enemy card to destroy:");
                    for (int i = 0; i < enemyCards.length; i++) {
                        if (enemyCards[i].getCardHP() > 0 && enemyCards[i].getCardHP() <= 5) {
                            System.out.println((i + 1) + ". " + enemyCards[i].getCardName() + " (HP " + enemyCards[i].getCardHP() + ")");
                        }
                    }
                    System.out.print(">> ");
                    String choice = App.scanner.nextLine().trim();
                    if (choice.length() != 1 || !Character.isDigit(choice.charAt(0))) {
                        System.out.println("Invalid input");
                        continue;
                    }

                    int idx = choice.charAt(0) - '1';
                    if (!eligibleIndices.contains(idx)) {
                        System.out.println("Invalid choice.");
                        continue;
                    }

                    targetIndex = idx;
                    break;
                }

                enemyCards[targetIndex].setCardHP(0);
                if (enemyPlayer.getActiveCard() == enemyCards[targetIndex]) {
                    Card replacementCard = null;
                    for (Card card : enemyCards) {
                        if (card.getCardHP() > 0) {
                            replacementCard = card;
                            break;
                        }
                    }
                    if (replacementCard != null) {
                        enemyPlayer.setActiveCard(replacementCard);
                    }
                    System.out.println("Enemy active card was destroyed.");
                }
                System.out.println(activeCard.getCardName() + " used its skill!");
                System.out.println(enemyCards[targetIndex].getCardName() + " was destroyed.");
            }
            default -> System.out.println("Invalid skill card.");
        }
    }

    private static boolean ensureBattleCanContinue(Player currentPlayer, Player enemyPlayer) {
        if (!refreshPlayerState(currentPlayer)) {
            System.out.println("Player " + enemyPlayer.getPlayerNumber() + " wins!");
            return false;
        }

        if (!refreshPlayerState(enemyPlayer)) {
            System.out.println("Player " + currentPlayer.getPlayerNumber() + " wins!");
            return false;
        }

        return true;
    }

    private static boolean refreshPlayerState(Player player) {
        Card[] cards = player.getSelectedCards();

        if (countAliveCards(cards) == 0) {
            return false;
        }

        if (player.getActiveCard().getCardHP() <= 0) {
            Card replacementCard = findNextAliveCard(player);
            if (replacementCard == null) {
                return false;
            }
            player.setActiveCard(replacementCard);
            System.out.println("Player " + player.getPlayerNumber() + "'s active card was destroyed. Switched to " + replacementCard.getCardName() + ".");
        }

        if (player.getActiveCard().getCardHP() > 0) {
            return true;
        }

        return true;
    }

    private static Card findNextAliveCard(Player player) {
        Card[] cards = player.getSelectedCards();
        int activeIndex = findCardIndex(cards, player.getActiveCard());
        if (activeIndex < 0) {
            activeIndex = 0;
        }

        for (int offset = 1; offset <= cards.length; offset++) {
            Card candidate = cards[(activeIndex + offset) % cards.length];
            if (candidate.getCardHP() > 0) {
                return candidate;
            }
        }

        return null;
    }

    private static int countAliveCards(Card[] cards) {
        int aliveCount = 0;
        for (Card card : cards) {
            if (card.getCardHP() > 0) {
                aliveCount++;
            }
        }
        return aliveCount;
    }

    private static int findCardIndex(Card[] cards, Card targetCard) {
        for (int i = 0; i < cards.length; i++) {
            if (cards[i] == targetCard) {
                return i;
            }
        }
        return -1;
    }

    private static int getRequiredSkillPoint(String cardName) {
        return switch (cardName) {
            case "Pyro Maniac" -> 1;
            case "Atlantic Siren" -> 2;
            case "Stone Golem" -> 2;
            case "Holy Paladin" -> 2;
            case "Grim Reaper" -> 3;
            default -> throw null;
        };
    }

    private static void printTopPlayerSection(Player player) {
        System.out.println("Player " + player.getPlayerNumber());
        System.out.println("Active Card: " + player.getActiveCard().getCardName());
        printCardBlock(player.getSelectedCards());
    }

    private static void printBottomPlayerSection(Player player) {
        printCardBlock(player.getSelectedCards());
        System.out.println("Player " + player.getPlayerNumber());
        System.out.println("Active Card: " + player.getActiveCard().getCardName());
    }

    private static void printCardBlock(Card[] cards) {
        printCardRow(cards, 0);
        printCardRow(cards, 1);
        printCardRow(cards, 2);
        printCardRow(cards, 3);
        printCardRow(cards, 4);
    }

    private static void printCardRow(Card[] cards, int rowType) {
        for (int i = 0; i < cards.length; i++) {
            Card card = cards[i];
            switch (rowType) {
                case 0, 4 -> System.out.print("+----+");
                case 1 -> {
                    if (card.getCardHP() < 10) {
                        System.out.print("|  " + card.getCardHP() + " |");
                    } else {
                        System.out.print("| " + card.getCardHP() + " |");
                    }
                }
                case 2 -> {
                    String initial = card.getCardInitial();
                    if (initial.length() == 1) {
                        System.out.print("| " + initial + "  |");
                    } else {
                        System.out.print("| " + initial + " |");
                    }
                }
                case 3 -> {
                    if (card.getCardSkillPoint() < 10) {
                        System.out.print("|  " + card.getCardSkillPoint() + " |");
                    } else {
                        System.out.print("| " + card.getCardSkillPoint() + " |");
                    }
                }
                default -> throw null;
            }
            if (i < cards.length - 1) {
                System.out.print(" ");
            }
        }
        System.out.println();
    }

}
