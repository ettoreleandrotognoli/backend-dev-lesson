import java.util.List;
import java.util.ArrayList;

public class JavaExample1 {


    static interface PropertyChangeListener{
        void propertyChanged(Object source, String property, Object oldValue, Object newValue);
    }

    static interface ObservableProperties{
        void addPropertyChangeListener(PropertyChangeListener listener);
        void removePropertyChangeListener(PropertyChangeListener listener);
    }

    static class PropertyChangeSupport implements ObservableProperties{

        private Object source;
        private List<PropertyChangeListener> listeners = new ArrayList<>();

        public PropertyChangeSupport(Object source){
            this.source = source;
        }

        public void addPropertyChangeListener(PropertyChangeListener listener){
            this.listeners.add(listener);
        }

        public void removePropertyChangeListener(PropertyChangeListener listener){
            this.listeners.remove(listeners);
        }

        public void firePropertyChanged(String property, Object oldValue, Object newValue){
            for(PropertyChangeListener listener : this.listeners){
                listener.propertyChanged(this.source,property,oldValue,newValue);
            }
        }

    }

    static abstract class Model {
        /**
        * Classe de algum framework que não pode ser alterada
        */
    }

    static class MyBaseModel extends Model implements ObservableProperties{

        protected PropertyChangeSupport propertyChangeSupport = new PropertyChangeSupport(this);

        public void addPropertyChangeListener(PropertyChangeListener listener){
            this.propertyChangeSupport.addPropertyChangeListener(listener);
        }

        public void removePropertyChangeListener(PropertyChangeListener listener){
            this.propertyChangeSupport.removePropertyChangeListener(listener);
        }

        protected void firePropertyChanged(String property, Object oldValue, Object newValue){
            this.propertyChangeSupport.firePropertyChanged(property,oldValue,newValue);
        }

    }

    static class MyModel extends MyBaseModel{

        public static final String PROP_ID = "id";
        public static final String PROP_NAME = "name";
        public static final String PROP_VALUE = "value";

        protected int id;
        protected String name;
        protected Object value;

        public void setId(int id){
            int old = this.id;
            this.id = id;
            this.firePropertyChanged(PROP_ID,old,id);
        }

        public int getId(){
            return this.id;
        }

        public void setName(String name){
            String old = this.name;
            this.name = name;
            this.firePropertyChanged(PROP_NAME,old,name);
        }

        public String getName(){
            return this.name;
        }

        public void setValue(Object value){
            Object old = this.value;
            this.value = value;
            this.firePropertyChanged(PROP_VALUE,old,value);
        }

        public Object getValue(){
            return this.value;
        }


    }

    public static void main(String... args){
        MyModel model = new MyModel();

        model.addPropertyChangeListener(new PropertyChangeListener(){
            public void propertyChanged(Object source,String property, Object oldValue, Object newValue){
                System.out.println(source.toString()+"::"+property+" = "+newValue+" ("+oldValue+")");
            }
        });

        model.setId(1);
        model.setName("teste");
        model.setValue(10);

        model.setId(2);
        model.setName("teste 2");
        model.setValue(11);
    }

}