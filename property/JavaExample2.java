public class JavaExample2 {

    /**
    * HSV Color
    */
    public static class Color{

        public float hue;
        public float saturation;
        public float value;

        public Color(float hue, float saturation,float value){
            this.hue = hue;
            this.saturation = saturation;
            this.value = value;
        }

        @Override
        public String toString(){
            return String.format("%s{hue:%f,saturation:%f,value:%f}",this.getClass().getSimpleName(),this.hue,this.saturation,this.value);
        }

    }

    /**
    * codigo quebrado
    */
    /*private static Color sumColors(Color... colors){
        int r =0;
        int g =0;
        int b =0;
        for(Color c : colors){
            r+= c.red;
            g+= c.green;
            b+= c.blue;
        }
        return new Color(r,g,b);
    }*/

    public static void main(String... args){
        Color red = new Color(0,1,1);
        Color blue = new Color(120,1,1);
        Color green = new Color(240,1,1);
        //Color white = sumColors(red,blue,green);
        Color white = new Color(0,0,1);
        System.out.println(white);
    }

}