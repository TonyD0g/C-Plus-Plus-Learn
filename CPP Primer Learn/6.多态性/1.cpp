//定义Point类，有坐标x,y两个成员变量，对Point类重载 "++" (自增),"--" (自减)
//运算符,实现对坐标值的改变

#include<iostream>
using namespace std;
class Point
{
    public:
        int x, y;
        Point(int a,int b)
        {
            x = a;
            y = b;
        }
        friend  Point operator--(Point &op);
        friend  Point operator++(Point &op);
};

 Point operator++(Point &op)
{
    op.x=op.x+1;
    op.y=op.y+1;
}

Point operator--(Point &op)
{
    op.x=op.x-1;
    op.y=op.y-1;
}

int main()
{
    Point p1(2, 3), p2(7, 8);
    ++p1;
    --p1;
    ++p2;
    --p2;
    return 0;
}
//no return statement in function returning non-void
