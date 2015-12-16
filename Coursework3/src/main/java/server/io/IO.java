package server.io;

import java.io.*;

/**
 * Handles IO operations.
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class IO {

    /**
     * get the structure (i.e. auth details, active lists, user info) from a file. or initialise it with default value if the file does not exist
     * @param relativePath the relative path of the file containing the structure
     * @param def the default value for the structure in case the file is not found
     * @param <T> the type of the structure
     * @return the structure read from file, or the default structure if the file does not exists
     */
    public static <T> T getStructureFromFile(String relativePath, T def) {
        T e = null;
        File file = new File(relativePath);
        if(!file.exists()) {
            try {
                file.createNewFile();
                writeSerialisedObject(relativePath, def);
            } catch (IOException e1) {
                e1.printStackTrace();
            }
        }
        return (T) readSerialisedObject(relativePath);
    }

    /**
     * read the serialised object from a file
     * @param relativepath the relative path of the file
     * @return the serialised object if any, or null otherwise.
     */
    public static Object readSerialisedObject(String relativepath) {
        Object e;
        try
        {
            // open input streams
            FileInputStream fileIn = new FileInputStream(relativepath);
            ObjectInputStream in = new ObjectInputStream(fileIn);
            e = in.readObject();
            // closing input streams
            in.close();
            fileIn.close();
            System.out.println("Serialized data is saved in " + relativepath);
            return e;
        }catch(IOException i)
        {
            i.printStackTrace();
            return null;
        }catch(ClassNotFoundException c)
        {
            System.out.println("Weird error: Object class not found");
            c.printStackTrace();
            return null;
        }
    }

    /**
     * Serialise the object to a file
     * @param relativePath the relative path of the file
     * @param o the object to be serialised
     * @return true if success, false otherwise.
     */
    public static boolean writeSerialisedObject(String relativePath, Object o) {
        try
        {
            FileOutputStream fileOut =
                    new FileOutputStream(relativePath);
            ObjectOutputStream out = new ObjectOutputStream(fileOut);
            out.writeObject(o);
            out.close();
            fileOut.close();
            System.out.println("Serialized data is saved in " + relativePath);
            return true;
        }catch(IOException i)
        {
            i.printStackTrace();
            return false;
        }
    }
}
