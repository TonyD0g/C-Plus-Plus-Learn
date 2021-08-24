# dequeue基本概念

* dequeue也是一个可数组，　deque在接口上和vector非常相似
* deque 上常见操作的复杂度（效率）如下：
  * 随机访问——常数 *O(1)*
  * 在结尾或起始插入或移除元素——常数 *O(1)*
  * 插入或移除元素——线性 *O(n)*



```c++
#include <iostream>
#include<queue>

using namespace std;

template <class T>
void Print(T first, T last) {
    for (; first!=last; ++first) {
        cout << *first << " ";
    }
    cout << endl;
}

int main() {
    deque<double> dq = {1.3, 5.4, 2.45};
    Print(dq.begin(), dq.end()); // 1.3 5.4 2.45

    dq.push_front(5.3);
    dq.push_back(0.122);
    Print(dq.begin(), dq.end()); // 5.3 1.3 5.4 2.45 0.122

    dq.pop_front();
    dq.pop_back();
    Print(dq.begin(), dq.end()); // 1.3 5.4 2.45

    cout << dq.front() << endl; // 1.3
    cout << dq.back() << endl; // 2.45
    Print(dq.begin(), dq.end()); // 1.3 5.4 2.45
    
    return 0;
}
```

