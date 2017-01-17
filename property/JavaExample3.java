public class JavaExample3 {

    public static interface RGB {
        int getRed();
        int getGreen();
        int getBlue();
    }

    public static class RGBColor implements RGB {
        private int red;
        private int green;
        private int blue;

        public RGBColor(int red, int green, int blue){
            this.red = red;
            this.green = green;
            this.blue = blue;
        }

        public int getRed(){
            return this.red;
        }

        public void setRed(int red){
            this.red = red;
        }

        public int getGreen(){
            return this.green;
        }

        public void setGreen(int green){
            this.green = green;
        }

        public int getBlue(){
            return this.blue;
        }

        public void setBlue(int blue){
            this.blue = blue;
        }

        @Override
        public String toString(){
            return String.format("%s{red:%d,green:%d,blue:%d}",this.getClass().getSimpleName(),this.red,this.green,this.blue);
        }
    }

    public static class HSVColor implements RGB{

        private float hue;
        private float saturation;
        private float value;

        public HSVColor(float hue, float saturation,float value){
            this.hue = hue;
            this.saturation = saturation;
            this.value = value;
        }

        public RGB toRGB(){
            float c = this.value * this.saturation;
            float x = c * ( 1.0f - Math.abs(((this.hue/60.0f) % 2) -1));
            float m = this.value - c;
            float rr =0;
            float gg =0;
            float bb = 0;
            if(0 <= this.hue && this.hue < 60){
                rr = c;
                gg = x;
                bb = 0;
            }
            else if(0 <= this.hue && this.hue < 120){
                rr = x;
                gg = c;
                bb = 0;
            }
            else if(120 <= this.hue && this.hue < 180){
                rr = 0;
                gg = c;
                bb = x;   
            }
            else if(180 <= this.hue && this.hue < 240){
                rr = 0;
                gg = x;
                bb = c;
            }
            else if(240 <= this.hue && this.hue < 300){
                rr = x;
                gg = 0;
                bb = c;
            }
            else if(300 <= this.hue && this.hue < 360){
                rr = c;
                gg = 0;
                bb = x;
            }
            return new RGBColor(Math.round((rr+m)*255),Math.round((gg+m)*255),Math.round((bb+m)*255));
        }

        public int getRed(){
            return this.toRGB().getRed();
        }

        public int getBlue(){
            return this.toRGB().getBlue();
        }

        public int getGreen(){
            return this.toRGB().getGreen();
        }

        @Override
        public String toString(){
            return String.format("%s{hue:%f,saturation:%f,value:%f}",this.getClass().getSimpleName(),this.hue,this.saturation,this.value);
        }
    }

    private static RGB sumColors(RGB... colors){
        int r =0;
        int g =0;
        int b =0;
        for(RGB c : colors){
            r+= c.getRed();
            g+= c.getGreen();
            b+= c.getBlue();
        }
        return new RGBColor(r,g,b);
    }

    public static void main(String... args){
        RGBColor rgbRed = new RGBColor(255,0,0);
        RGBColor rgbBlue = new RGBColor(0,255,0);
        RGBColor rgbGreen = new RGBColor(0,0,255);
        RGB white = sumColors(rgbRed,rgbBlue,rgbGreen);
        System.out.println(white);

        HSVColor hsvRed = new HSVColor(0,1f,1f);
        HSVColor hsvBlue = new HSVColor(120,1f,1f);
        HSVColor hsvGreen = new HSVColor(240,1f,1f);
        white = sumColors(hsvRed,hsvBlue,hsvGreen);
        System.out.println(white);

        white = sumColors(rgbRed,hsvBlue,rgbGreen);
        System.out.println(white);
    }
}