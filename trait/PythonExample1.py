# -*- encoding: utf-8 -*-
class PropertyChangeListener(object):

    def propertyChanged(self,source,property,old,new):
        raise NotImplementedError()

class ObservableProperties(object):

    def addPropertyChangeListener(self,listener):
        raise NotImplementedError()

    def removePropertyChangeListener(self,listener):
        raise NotImplementedError()


class PropertyChangeSupport(object):

    def __init__(self,*args,**kwargs):
        self.listeners = []

    def addPropertyChangeListener(self,listener):
        self.listeners.append(listener)

    def removePropertyChangeListener(self,listener):
        self.listeners.remove(listener)

    def _firePropertyChanged(self,property,old,new):
        for listener in self.listeners:
            listener.propertyChanged(self,property,old,new)

class Properties(object):

    def __init__(self,**kwargs):
        for kv in kwargs.items():
            super(Properties,self).__setattr__(*kv)

    def __setattr__(self,key,value):
        old = getattr(self,key,None)
        super(Properties,self).__setattr__(key,value)
        self._firePropertyChanged(key,old,value)



class Model(object):
    """
     Classe de algum framework que não pode ser alterada
    """

class MyModel(Model,PropertyChangeSupport,Properties):

    def __init__(self):
        super(MyModel,self).__init__(
            id=None,
            name=None,
            value=None
        )
        

class DebugPropertyChangeListener(PropertyChangeListener):

    def propertyChanged(self,source,property,old,new):
        print(source,property,old,new)

model = MyModel()
model.addPropertyChangeListener(DebugPropertyChangeListener())
model.id = 1
model.name = 'teste'
model.value = 10
model.id = 2
model.name = 'teste 2'
model.value = 11