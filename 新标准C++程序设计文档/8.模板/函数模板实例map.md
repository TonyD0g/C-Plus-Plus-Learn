```c++
#include <iostream>
using namespace std;
// s, e, x均是指针, op是函数指针
// 将[s, e)区间的数据通过op()转换后存放在x中
template<class T, class Pred>
void Map (T s, T e, T x, Pred op){
    for (; s!=e; ++s, ++x) {
        *x = op(*s);
    }
}

int Cube(int x) {
    return x*x*x;
}

double Squre(double x) {
    return x*x;
}

int  main(int argc, char* arg[])
{
    //
    int a[] = {1, 2, 3, 4, 5}, b[5];

    Map(a, a+5, b, Cube);
    for (int i=0; i<sizeof(b)/sizeof(int); ++i) {
        cout << b[i] << " ";  // 输出：1 8 27 64 125
    }

    cout << endl;
    Map(a, a+5, b, Squre);
    for (int i=0; i<sizeof(b)/sizeof(int); ++i) {
        cout << b[i] << " "; // 输出：1 4 9 16 25
    }

    //
    cout << endl;
    double c[] = {1.1, 2.1, 3.1, 4.1, 5.1}, d[5];
    
    Map(c, c+5, d, Squre);
    for (int i=0; i<sizeof(d)/sizeof(double); ++i) {
        cout << d[i] << " ";  // 输出：1.21 4.41 9.61 16.81 26.01
    }


    return 0;
}
```

