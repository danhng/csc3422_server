package server;

import uk.ac.ncl.csc3422.kennelbooking.DogSize;
import uk.ac.ncl.csc3422.kennelbooking.Kennel;
import uk.ac.ncl.csc3422.kennelbooking.KennelFactory;

import javax.servlet.http.HttpServletRequest;
import java.lang.reflect.Array;
import java.util.Date;

/**
 * Utilities for the kennel site.
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class KennelAppUtilities {

    /**
     * make a string displayed correctly to the browsers.
     * @param r the string to be manipulated.
     * @return the manipulated string.
     */
    public static String addHtmlNewLines(String r) {
        String[] lines = r.split("\n");
        String html = "";
        for (int i = 0; i < lines.length; i++) {
                html += lines[i] + ((i == lines.length - 1) ? "" : "<br/>");
        }
        return html;
    }

    /**
     * test if a dog name is in a kennel
     * @param kennel the kennel
     * @param dogname the name of the dog
     * @return true if the dog's name is in the kennel, false otherwise
     */
    public static boolean isDogNameUsed(Kennel kennel, String dogname) {
            for (int i = 0; i < kennel.getPens().size(); i++) {
                if (kennel.getPens().get(i).getDogName().equalsIgnoreCase(dogname))
                    return true;
            }
        return false;
    }

    /**
     * Convert dog size in integer to correct enum type
     * @param i the integer to be converted to enum DogSize
     * @return the corresponding enum, or null if the integer is not compatible.
     */
    public static DogSize intToSize(int i) {
        switch (i) {
            case 1:
                return DogSize.SMALL;
            case 2:
                return DogSize.MEDIUM;
            case 3:
                return DogSize.GIANT;
            default:
                return null;
        }
    }

    /**
     * Dump a log message with client info
     * @param req the request from client
     * @param message the message to be dumped.
     */
    public static void logReq(HttpServletRequest req, String message) {
        System.out.println(req.getHeader("user-agent") + " " + new Date().toLocaleString() + ": " + message);
    }
}
