import java.lang.reflect.Method;
import java.lang.reflect.Constructor;
import java.lang.reflect.Field;

public class JavaExample3{

    static class Controller {

        private Object requiredThing;
        private Object otherThing;

        public Controller(Object requiredThing, Object otherThing){
            if(requiredThing == null){
                throw new RuntimeException("The param requiredThing is required");
            }
            this.requiredThing = requiredThing;
            this.otherThing = otherThing;
            System.out.println("requiredThing is a " + this.requiredThing.getClass());
        }

        public Controller(Object requiredThing){
            this(requiredThing,null);
        }

        public String get(Object resquest, String param){
            System.out.println(resquest.getClass());
            return String.format("Hello %s!!!",param);
        }

        public Object getOtherThing(){
            return this.otherThing;
        }

        public void setOtherThing(Object otherThing){
            this.otherThing = otherThing;
        }

    }


    public static void main(String... args) throws Exception{
        String controllerClassName = "JavaExample3$Controller";
        Class<?> controllerClass = Class.forName(controllerClassName,true,JavaExample1.class.getClassLoader());

        Constructor constructor = controllerClass.getConstructor(Object.class);

        Object someThing = "someThing";
        Object controllerInstance = constructor.newInstance(someThing);

        
        String setMethodName = "setOtherThing";
        Method setMethod = controllerClass.getMethod(setMethodName,Object.class);

        String getMethodName = "getOtherThing";
        Method getMethod = controllerClass.getMethod(getMethodName);

        System.out.println(getMethod.invoke(controllerInstance));
        setMethod.invoke(controllerInstance,new Integer(666));
        System.out.println(getMethod.invoke(controllerInstance));

        Field otherThingField = controllerClass.getDeclaredField("otherThing");
        try{
            otherThingField.set(controllerInstance,new Integer(777));
        }
        catch(Exception ex){
            ex.printStackTrace();
        }
        otherThingField.setAccessible(true);
        System.out.println(otherThingField.get(controllerInstance));
        otherThingField.set(controllerInstance,new Integer(888));
        System.out.println(getMethod.invoke(controllerInstance));

    }

}