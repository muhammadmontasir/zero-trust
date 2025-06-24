import { Component, OnInit } from "@angular/core";
import { HttpClient } from "@angular/common/http";

@Component({
    selector: 'app-product-list',
    standalone: true,
    templateUrl: './product-list.component.html'
})

export class ProductListComponent implements OnInit {
    products: any[] = [];

    constructor(private http: HttpClient) { }

    ngOnInit(): void {
        this.http.get<any>('http://localhost:8081/api/list_products.php').subscribe(res => {
            this.products = res.products;
        });
    }
}

