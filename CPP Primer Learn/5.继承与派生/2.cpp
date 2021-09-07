/*
    
*/

#include<iostream>
using namespace std;
class Basic
{
    protected:
        double r;
    public:
        Basic() 
        {
             r = 0; 
        }
        Basic(double a):r(a)
        {

        }
};
class Circular:public Basic
{
    protected:
        double area;
    public:
    /*  void Circular(double a)
        {
            r = a;
            area = 3.14 * r * r;
        }*/
         Circular(double a);
        double getArea()
        {
            return area;
        }
};
 Circular::Circular(double a)
{
    r = a;
            area = 3.14 * r * r;
}
class Column:public Circular
{
    protected:
        double h;
        double cubage;
    public:
        Column(double a,double b):Circular(a)
        {
            h = b;
            cubage = getArea() * h;

        }
        double getCubage()
        {
            return cubage;
        }
};
int main()
{
    Circular circular(45.0);
    Column Column(12, 10);
    cout << "圆的面积：   " << circular.getArea() << endl;
    cout << "圆柱的面积:     " << Column.getCubage() << endl;
    return 0;
}