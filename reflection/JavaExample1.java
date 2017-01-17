import java.lang.reflect.Method;

public class JavaExample1{

    static class Controller {

        public String get(Object resquest, String param){
            System.out.println(resquest.getClass());
            return String.format("Hello %s!!!",param);
        }

    }


    public static void main(String... args) throws Exception{
        String controllerClassName = "JavaExample1$Controller";
        Class<?> controllerClass = Class.forName(controllerClassName,true,JavaExample1.class.getClassLoader());
        Object controllerInstance = controllerClass.newInstance();
        String methodName = "get";
        Method method = controllerClass.getMethod(methodName,Object.class,String.class);
        System.out.println(method.invoke(controllerInstance,new Object(),"World"));
    }

}