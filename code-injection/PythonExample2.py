
def log_method(method):
    def wrapper(self,*args,**kwargs):
        print('%s:%s(*%s,**%s)' % (self.__class__.__name__,method.__name__,str(args),str(kwargs)))
        result = method(self,*args,**kwargs)
        print('%s:%s(*%s,**%s) -> %s' % (self.__class__.__name__,method.__name__,str(args),str(kwargs),str(result)))
        return result
    return wrapper

def log_class(clazz):
    for name,value in clazz.__dict__.items():
        if not hasattr(value,'__call__'):
            continue
        setattr(clazz,name,log_method(value))
        
    return clazz



@log_class
class Calc(object):

    def sum(self,a,b):
        return a + b

    def sub(self,a,b):
        return a - b

    def mul(self,a,b):
        return a * b

    def div(self,a,b):
        return a / b


c = Calc()
c.sum(334,332);
c.sub(999,333);
c.mul(7,7);
c.div(121,11);