package server.auth;

import server.Config;
import server.io.IO;

import java.io.*;
import java.util.HashMap;
import java.util.HashSet;

/**
 * Storage implementation for auth engine.
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class AuthStorage {

    /**
     * Is username in the storage
     * @param username the tested username
     * @return true if it is in the storage, false otherwise
     */
    public static boolean usernamePicked(String username) {
        return getAuth().containsKey(username);
    }

    /**
     * Get the password for a username
     * @param username the username for which password is retrieved
     * @return the password, or null.
     */
    public static String getPassword(String username) {
        return getAuth().get(username);
    }

    /**
     * add a new username - password record
     * @param username the username
     * @param password the password
     */
    public static void add(String username, String password) {
        HashMap<String, String> auth = getAuth();
        assert auth != null;
        auth.put(username, password);
        // flush to storage
        IO.writeSerialisedObject("auth.ser", auth);
    }

    /**
     * mark a user as active
     * @param username the username to be marked as active
     */
    public static void active(String username) {
        HashSet<String> actives  = getActives();
        assert actives != null;
        actives.add(username);
        // flush to storage
        IO.writeSerialisedObject("active.ser", actives);
    }

    /**
     * mark a user as not active
     * @param username the username to mark not active
     */
    public static void deactive(String username) {
        HashSet<String> actives  = getActives();
        assert actives != null;
        actives.remove(username);
        IO.writeSerialisedObject("active.ser", actives);
    }

    /**
     * reset active list
     */
    public static void resetActiveList() {
        File activeFile = new File("active.ser");
        if(!activeFile.exists()) {
            try {
                activeFile.createNewFile();
            } catch (IOException e1) {
                e1.printStackTrace();
            }
        }
            IO.writeSerialisedObject("active.ser", new HashSet<String>());
    }

    /**
     * test if a user if currently active
     * @param username the username to be tested
     * @return true if the user is active, false otherwise
     */
    public static boolean isActive(String username) {
        return getActives().contains(username);
    }

    /**
     * get auth data containing all user authentication records from storage
     * @return the auth data structure.
     */
    public static HashMap<String, String> getAuth() {
        return IO.getStructureFromFile(Config.authFile, new HashMap<String, String>());
    }

    /**
     * get active users data containing all active users from storage
     * @return the active users data structure.
     */
    public static HashSet<String> getActives() {
        return IO.getStructureFromFile(Config.activeFile, new HashSet<String>());
    }
}
