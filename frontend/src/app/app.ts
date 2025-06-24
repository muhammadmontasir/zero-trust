import { Component } from '@angular/core';
import { UploadComponent } from './components/upload.component';
import { ProductListComponent } from './components/product-list.component';
import { TotalPriceComponent } from './components/total-price.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [UploadComponent, ProductListComponent, TotalPriceComponent],
  templateUrl: './app.html',
  styleUrl: './app.css'
})
export class App {
  protected title = 'frontend';
}