
import java.util.Random;
import java.util.Scanner;

public class App {

    static Random random = new Random();

    public static void main(String[] args) throws Exception {  

        int menu = 0;
        try(Scanner input = new Scanner(System.in)) {
            while(menu != 2) 
            {
                System.out.println("\nHangman Game \n1. Start Game \n2. Exit");
                System.out.print(">> ");
                menu = input.nextInt();

                switch (menu) {
                    case 1 -> game(input);
                    case 2 -> System.exit(0);
                    default -> System.out.println("pake 1 / 2");
                }
            }
        } // close scanner

    } // close psvm

    public static void game(Scanner input) {

        String[] words = {"apple", "banana", "sheep", "rabbit", "java", "programming"};
        String[] hangman = {"|===|","|   O","|   ^","|   |", "|   ^"};
        String guessWord = words[random.nextInt(words.length)];
        String hiddenWord = "_ ".repeat(guessWord.length()); // ijin make repeat ketimbang nge for-loop
        int lives = 5;
        
        while (lives > 0)
        {
            System.out.println("\nLives: " + lives);
            System.out.println("Current guess: " + hiddenWord);
            System.out.print("Guess: ");
            String guess = input.next().toLowerCase();

            for (int i = 0; i < guessWord.length(); i++)
                if (guessWord.charAt(i) == guess.charAt(0))
                    hiddenWord = hiddenWord.substring(0, i * 2) + guess + hiddenWord.substring(i * 2 + 1); // di kali 2 buat spasinya "_ "
            
            if (!guessWord.contains(guess)) {
                System.out.println("Wrong!"); lives--;
                for (int i = lives; i < hangman.length; i++) System.out.println(hangman[i]);
            }

            if (lives == 0) { System.out.println("You lost! The word was: " + guessWord); break; }

            if (!hiddenWord.contains("_")) { System.out.println("Congratzz! You've guessed the word: " + guessWord); break; }
        }

    } // close psv game

}