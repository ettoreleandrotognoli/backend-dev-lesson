import java.io.PrintStream;
import java.lang.reflect.Method;
import java.lang.reflect.Parameter;
import java.lang.reflect.InvocationHandler;
import java.lang.reflect.Proxy;
import java.util.Arrays;

public class JavaExample2 {

    public static interface Calc{
        double sum(double a,double b);
        double sub(double a, double b);
        double mul(double a, double b);
        double div(double a,double b);
    }

    public static class InvocationLogger<E> implements InvocationHandler {

        private PrintStream logOuput;
        private E object;

        public InvocationLogger(PrintStream logOuput, E object){
            this.logOuput = logOuput;
            this.object = object;
        }

        public Object invoke(Object proxy,Method method,Object[] args) throws Throwable{
            StringBuilder sb = new StringBuilder();
            sb.append(this.object.getClass().getSimpleName())
              .append("::")
              .append(method.getName())
              .append('(');
            Parameter[] parameters = method.getParameters();
            for(int i=0;i<parameters.length;i+=1){
                Parameter p = parameters[i];
                Object value = args[i];
                if(i>0){
                    sb.append(';');
                }
                sb.append(p.getName()).append('=').append(args[i]);
            }
            sb.append(')');
            logOuput.println(sb.toString());
            Object result = method.invoke(this.object,args);
            sb.append(" -> ").append(result);
            logOuput.println(sb.toString());
            return result;
        }

    }

    public static class CalcImpl implements Calc{


        public double sum(double a,double b){
            return a + b;
        }

        public double sub(double a,double b){
            return a - b;
        }

        public double mul(double a,double b){
            return a * b;
        }

        public double div(double a,double b){
            return a / b;
        }

    }


    public static void main(String... args){
        InvocationHandler invocationHandler = new InvocationLogger<Calc>(System.out,new CalcImpl());
        Calc c = (Calc) Proxy.newProxyInstance(JavaExample2.class.getClassLoader(),new Class[]{Calc.class},invocationHandler);
        c.sum(334,332);
        c.sub(999,333);
        c.mul(7,7);
        c.div(121,11);
    }

}