class Controller(object):

    def __init__(self,requiredThing,otherThing=None):
        if requiredThing is None:
            raise exception('requiredThing is required')
        self._requiredThing = requiredThing
        self._otherThing = otherThing
        self.__otherThing = otherThing
        print('requiredThing is a ' + type(requiredThing).__name__)
    
    def get(self,request,param):
        print dir(request)
        return 'Hello %s!!!' % param

    def setOtherThing(self,otherThing):
        self._otherThing = otherThing

    def getOtherThing(self):
        return self._otherThing


controllerClassName = 'Controller'
controllerClass = globals()[controllerClassName]

someThing = (1,2,3,4,5,)
controllerInstance = controllerClass(someThing)


getMethodName = 'getOtherThing'
getMethod = getattr(controllerInstance,getMethodName)
print(getMethod())


setMethodName = 'setOtherThing'
setMethod = getattr(controllerInstance,setMethodName)
setMethod(666)
print(getMethod())


setattr(controllerInstance,'_otherThing',777)
print(getMethod())


print controllerInstance.__dict__