import { Component, OnInit } from "@angular/core";
import { HttpClient } from "@angular/common/http";

@Component({
    selector: 'app-total-price',
    standalone: true,
    templateUrl: './total-price.component.html'
})

export class TotalPriceComponent implements OnInit {
    total: number | null = null;

    constructor(private http: HttpClient) { }

    ngOnInit(): void {
        this.http.get<any>('http://localhost:8081/api/sum_total.php').subscribe({
            next: res => {
                this.total = res.total_price;
            },
            error: err => {
                console.error('Failed to fetch total:', err);
            }
        });
    }
}