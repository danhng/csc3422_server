package server;

/**
 * Store configuration file names i.e. auth storage files.
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class Config {

    public static final String authFile = "auth.ser";
    public static final String activeFile = "active.ser";
    public static final String secretKey = "sk.ser";
    public static String userInfoFile(String username) {
        return username + ".ser";
    }
}
