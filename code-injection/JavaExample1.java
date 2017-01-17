import java.io.PrintStream;

public class JavaExample1 {

    public static class Calc{

        private PrintStream logOuput;

        public Calc(PrintStream logOuput){
            this.logOuput = logOuput;
        }

        public double sum(double a,double b){
            this.logOuput.println(String.format("%s::sum(a=%.2f;b=%.2f)",this.getClass().getSimpleName(),a,b));
            double result = a + b;
            this.logOuput.println(String.format("%s::sum(a=%.2f;b=%.2f) -> %.2f",this.getClass().getSimpleName(),a,b,result));
            return result;
        }

        public double sub(double a,double b){
            this.logOuput.println(String.format("%s::sub(a=%.2f;b=%.2f)",this.getClass().getSimpleName(),a,b));
            double result =  a - b;
            this.logOuput.println(String.format("%s::sub(a=%.2f;b=%.2f) -> %.2f",this.getClass().getSimpleName(),a,b,result));
            return result;
        }

    }


    public static void main(String... args){
        Calc c = new Calc(System.out);
        c.sum(334,332);
        c.sub(999,333);
    }

}