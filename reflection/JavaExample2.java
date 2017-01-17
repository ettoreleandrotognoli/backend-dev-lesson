import java.lang.reflect.Method;
import java.lang.reflect.Constructor;

public class JavaExample2{

    static class Controller {

        private Object requiredThing;

        public Controller(Object requiredThing){
            if(requiredThing == null){
                throw new RuntimeException("The param requiredThing is required");
            }
            this.requiredThing = requiredThing;
            System.out.println("requiredThing is a " + this.requiredThing.getClass());
        }

        public String get(Object resquest, String param){
            System.out.println(resquest.getClass());
            return String.format("Hello %s!!!",param);
        }

    }


    public static void main(String... args) throws Exception{
        String controllerClassName = "JavaExample2$Controller";
        Class<?> controllerClass = Class.forName(controllerClassName,true,JavaExample1.class.getClassLoader());

        

        Constructor constructor = controllerClass.getConstructor(Object.class);
        try{
            constructor.newInstance();
        }
        catch(Exception ex){
            ex.printStackTrace();
        }

        Object someThing = "someThing";
        Object controllerInstance = constructor.newInstance(someThing);

        String methodName = "get";
        Method method = controllerClass.getMethod(methodName,Object.class,String.class);
        System.out.println(method.invoke(controllerInstance,new Object(),"World"));
    }

}