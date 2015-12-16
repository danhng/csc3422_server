package server.user;

import server.KennelAppUtilities;
import server.crypto.Crypto;
import server.io.IO;
import uk.ac.ncl.csc3422.kennelbooking.Kennel;
import uk.ac.ncl.csc3422.kennelbooking.Pen;
import javax.servlet.http.HttpServletRequest;
import java.util.HashMap;
import java.util.Map;

/**
 * represent a user with operations (book, checkout) at storage level.
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class User {
    String username;
    HashMap<String, String> dogs;

    public User(String username) {
        assert !username.isEmpty();
        this.username = username;
        // retrieve the dogs for this user
        dogs = IO.getStructureFromFile(User.getFileInfoName(username), new HashMap<String, String>());
    }

    /**
     * book a pen for a dog (storage level)
     * @param dogSize the size of the dog
     * @param dogName the name of the dog
     * @param k the kennel from which a pen is booked
     * @param req the request from the clients
     * @return the pen for which the dog is booked
     */
    public Pen bookADog(int dogSize, String dogName, Kennel k, HttpServletRequest req) {
        if (!KennelAppUtilities.isDogNameUsed(k, dogName)) {
            Pen p = k.bookPen(KennelAppUtilities.intToSize(dogSize), dogName);
            if (p != null) {
                dogs.put(String.valueOf(p.getPenNumber()), p.getDogName());
                // flush to file
                IO.writeSerialisedObject(User.getFileInfoName(username), dogs);
                return p;
            }
            else {
                KennelAppUtilities.logReq(req, "Booking " + dogName + " / " + dogSize + " for user " + username + " failed.");
                return null;
            }
        }
        else {
            KennelAppUtilities.logReq(req, "Warning, dog " + dogName + " has already in booking list of user " + username);
            return null;
        }
    }

    /**
     * check out a dog (storage level)
     * @param dogName the name of the dog
     * @param k the kennel from which the dog is checked out
     * @param req the request from the server
     * @return true if checkout is successful, false otherwise
     */
    public boolean checkoutADog(String dogName, Kennel k, HttpServletRequest req) {
        if (KennelAppUtilities.isDogNameUsed(k, dogName)) {
            boolean b = k.checkout(dogName);
            if (b) {
                for (Map.Entry<String, String> dog : dogs.entrySet()) {
                    if (dog.getValue().equalsIgnoreCase(dogName)) {
                        dogs.remove(dog.getKey());
                        break;
                    }
                }
                // flush to file
                IO.writeSerialisedObject(User.getFileInfoName(username), dogs);
                KennelAppUtilities.logReq(req, "Confirmed pen " + dogName + " removed from " + username);
                return true;
            }
            else {
                KennelAppUtilities.logReq(req, "Checkout " + dogName + " for user " + username + " failed.");
                return false;
            }
        }
        else {
            KennelAppUtilities.logReq(req, "Warning, dog " + dogName + " record is not in the system. " + username);
            return false;
        }
    }

    /**
     * get the real encrypted file name for user info
     * @param username the username
     * @return the file name containing booking data for this user
     */
    public static String getFileInfoName(String username) {
        return Crypto.getInstance().encrypt(username) + ".ser";
    }

    /**
     * create a status string for the user containing booking information which could be displayed in the website.
     * @return the status string
     */
    public String status() {
        String r = "";
        for (Map.Entry<String, String> dog: dogs.entrySet()) {
            r += dog.getValue() + " booked for pen " + dog.getKey() + "\n";
        }
        return r;
    }

    @Override
    public String toString() {
        String dogsString = "";
        for (Map.Entry<String, String> dog: dogs.entrySet()) {
            dogsString += dog.getValue() + " booked for pen " + dog.getKey() + "\n";
        }
        String r =  "User{" +
                "username='" + username + '\'' +
                ", dogsBooked=" + dogsString +
                '}';
        return r;
    }
}
