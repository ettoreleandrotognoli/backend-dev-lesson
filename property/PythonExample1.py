class POPO(object):

    def __init__(self,name):
        self.name = name

    def __str__(self):
        return self.name


obj = POPO('teste')
print(obj)
obj.name = 'outro teste'
print(obj)