package server.crypto;

/**
 * Simple DES Encryption used for all encryption in the system (NOT SECURE!)
 * Important: the DES encryption might contain forward slashes,
 * which is not desirable as it could cause file name to contain slashes,
 * which is dangerous (file not found exception mitgh be thrown).
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 * See href='http://www.java2s.com/Code/Java/Security/EncryptingaStringwithDES.htm
 */

import server.Config;
import server.io.IO;

import javax.crypto.*;
import java.io.UnsupportedEncodingException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;

public class Crypto {
    Cipher ecipher;
    Cipher dcipher;

    // singleton instance
    private static Crypto INSTANCE;

    private Crypto(SecretKey key) {
        try {
            ecipher = Cipher.getInstance("DES");
            dcipher = Cipher.getInstance("DES");
            ecipher.init(Cipher.ENCRYPT_MODE, key);
            dcipher.init(Cipher.DECRYPT_MODE, key);
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        } catch (NoSuchPaddingException e) {
            e.printStackTrace();
        } catch (InvalidKeyException e) {
            e.printStackTrace();
        }
    }

    /**
     * get the sole instance of the class
     * initialise it first if needs be
     * @return the instance
     */
    public static Crypto getInstance() {
        if (INSTANCE == null) {
            // get the secret key from storage
            SecretKey key = (SecretKey) IO.readSerialisedObject(Config.secretKey);
            return INSTANCE = new Crypto(key);
        }
        return INSTANCE;
    }

    /**
     * encrypt the string
     * replace any resulting forward slash with asterisk, which is not part of the base64 encoder.
     * @param str the string to be encrypted
     * @return the encrypted string, with any forward slash replaced by asterisk
     */
    public String encrypt(String str){
        try {
            // Encode the string into bytes using utf-8
            byte[] utf8 = str.getBytes("UTF8");

            // Encrypt
            byte[] enc = ecipher.doFinal(utf8);

            // Encode bytes to base64 to get a string
            // any forward slashes must be replaced by * (which is not part of the Base64 encoder returning values).
            return new sun.misc.BASE64Encoder().encode(enc).replace("/", "*");
        } catch (BadPaddingException e) {
            e.printStackTrace();
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        } catch (IllegalBlockSizeException e) {
            e.printStackTrace();
        }
        return null;
    }

    /**
     * Decrypt a string (all asterisks are first replaced by forward slashes)
     * @param str the string to be decrypted
     * @return the decrypted string
     * @throws Exception
     */
    public String decrypt(String str) throws Exception {
        // Decode base64 to get bytes
        // Any asterisks must be replaced by forward slashes to retrieve the original DES encrypted text
        byte[] dec = new sun.misc.BASE64Decoder().decodeBuffer(str.replace("*", "/"));

        byte[] utf8 = dcipher.doFinal(dec);

        // Decode using utf-8
        return new String(utf8, "UTF8");
    }

    /**
     * get a random key
     * @return the random key generated
     */
    public static SecretKey randomKey() {
        try {
            return KeyGenerator.getInstance("DES").generateKey();
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        return null;
    }
}
