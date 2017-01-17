class Controller(object):
    
    def get(self,request,param):
        print dir(request)
        return 'Hello %s!!!' % param


controllerClassName = 'Controller'
controllerClass = globals()[controllerClassName]

controllerInstance = controllerClass()

methodName = 'get'

print(getattr(controllerInstance,methodName)(object(),'World'))