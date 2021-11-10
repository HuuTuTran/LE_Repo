# 1. cho 1 dãy số 123456789
# chèn vào giữa các số 1 phép toán (+, - or none) để ra kết quả 100
# yêu cầu: 
# - không dùng package itertools
# - không dùng 9 vòng for
import numpy
def FindSign():
    S='123456789'
    list_result=[]
    expd=[]
    for i in S:
        expd.append(['%s+'%i,'%s-'%i,'%s'%i])
    expd=expd[:-1]
    a = [[0,1,2]]*8
    lst=[list(x) for x in numpy.array(numpy.meshgrid(*a)).T.reshape(-1,len(a))]
    for i in lst:
        i0,i1,i2,i3,i4,i5,i6,i7=i
        quote=''
        quote+=expd[0][i0]+expd[1][i1]+expd[2][i2]
        quote+=expd[3][i3]+expd[4][i4]+expd[5][i5]
        quote+=expd[6][i6]+expd[7][i7]+S[-1]        
        total=eval(quote)
        if total==100:
            list_result.append(quote)
    return list_result
print('list_result',FindSign())
