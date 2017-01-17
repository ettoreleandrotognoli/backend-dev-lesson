class Controller(object):

    def __init__(self,requiredThing):
        if requiredThing is None:
            raise exception('requiredThing is required')
        self._requiredThing = requiredThing
        print('requiredThing is a ' + type(requiredThing).__name__)
    
    def get(self,request,param):
        print dir(request)
        return 'Hello %s!!!' % param


controllerClassName = 'Controller'
controllerClass = globals()[controllerClassName]

someThing = (1,2,3,4,5,)
controllerInstance = controllerClass(someThing)

methodName = 'get'

print(getattr(controllerInstance,methodName)(object(),'World'))