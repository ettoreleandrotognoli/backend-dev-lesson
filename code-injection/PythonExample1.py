
def log(method):
    def wrapper(self,*args,**kwargs):
        print('%s:%s(*%s,**%s)' % (self.__class__.__name__,method.__name__,str(args),str(kwargs)))
        result = method(self,*args,**kwargs)
        print('%s:%s(*%s,**%s) -> %s' % (self.__class__.__name__,method.__name__,str(args),str(kwargs),str(result)))
        return result
    return wrapper

class Calc(object):

    @log
    def sum(self,a,b):
        return a + b

    @log
    def sub(self,a,b):
        return a - b

    @log
    def mul(self,a,b):
        return a * b

    @log
    def div(self,a,b):
        return a / b


c = Calc()
c.sum(334,332);
c.sub(999,333);
c.mul(7,7);
c.div(121,11);