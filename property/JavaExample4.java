public class JavaExample4 {

    public static class POJO{
        private String name;

        public POJO(String name){
            this.name = name;
        }

        public POJO(){
            this(null);
        }

        public String getName(){
            return this.name;
        }

        public void setName(String name){
            this.name = name;
        }

        public String toString(){
            return this.name;
        }
    }

    public static void main(String... args){
        POJO obj = new POJO("teste");
        System.out.println(obj);
        obj.setName("outro teste");
        System.out.println(obj);
    }

}