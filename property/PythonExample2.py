class POPO(object):

    def __init__(self,name):
        self._name = name

    def set_name(self,name):
        self._name = name

    def get_name(self):
        return self._name

    def __str__(self):
        return self.name

    name = property(get_name,set_name)


obj = POPO('teste')
print(obj)
obj.name = 'outro teste'
print(obj)