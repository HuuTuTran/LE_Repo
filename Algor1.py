# 2. cho trước 2 số y, x (y > x). Có 2 cách thay đổi giá trị của x:
#     - tăng gấp đôi x
#     - bớt x đi 1 đơn vị
# Tìm số bước nhỏ nhất để x = y.
def MinChange(x,y):
    if x > y:
        return
    else:
        count = 0
        while x != y:
            if x > y:
                x -= 1
            elif 2*x <= y or (2*x > y and y%2==1):
                x *=2
            elif 2*x > y and y%2==0:
                x -=1
            count  += 1
            print(f"x:{x},y:{y}")
        return count
        
