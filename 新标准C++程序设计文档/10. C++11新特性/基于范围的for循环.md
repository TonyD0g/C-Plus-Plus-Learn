* c++11引入了for循环的新写法，在遍历整个数组或容器时，不需要循环控制变量 

  ```c++
  #include <iostream>
  #include <vector>
  
  using namespace std;
  
  struct A {
      int n;
      A(int i) : n(i) {}
  };
  
  int main() {
  
      int a[] = {1, 2, 3, 4, 5};
      for (int e : a) {
          cout << e << " ";
      }
      cout << endl; // 1 2 3 4 5 
  
      vector<A> st(a, a+5);
      for (auto &e: st) {
          e.n *=10;
          cout << e.n << " "; // 10 20 30 40 50
      }
  
      return 0;
  }
  ```

  

