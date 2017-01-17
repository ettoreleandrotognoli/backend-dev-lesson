public class JavaExample1 {

    /**
    * RGB Color
    */
    public static class Color{

        public int red;
        public int green;
        public int blue;

        public Color(int red, int green, int blue){
            this.red = red;
            this.green = green;
            this.blue = blue;
        }

        @Override
        public String toString(){
            return String.format("%s{red:%d,green:%d,blue:%d}",this.getClass().getSimpleName(),this.red,this.green,this.blue);
        }

    }

    private static Color sumColors(Color... colors){
        int r =0;
        int g =0;
        int b =0;
        for(Color c : colors){
            r+= c.red;
            g+= c.green;
            b+= c.blue;
        }
        return new Color(r,g,b);
    }

    public static void main(String... args){
        Color red = new Color(255,0,0);
        Color blue = new Color(0,255,0);
        Color green = new Color(0,0,255);
        Color white = sumColors(red,blue,green);
        System.out.println(white);
    }

}