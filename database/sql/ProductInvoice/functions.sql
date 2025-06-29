CREATE OR REPLACE FUNCTION insert_input_or_output_product_when_product_invoice_approve()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.status = 'APPROVED' THEN
        IF NEW.type = 'INPUT' THEN
            INSERT INTO input_products (
                product_id,
                quantity,
                user_id,
                date,
                product_invoice_id,
                created_at,
                updated_at
            )
            SELECT
                product.product_id,
                product.quantity,
                product.user_id,
                product.date,
                product.product_invoice_id,
                NOW(),
                NOW()
            FROM product_invoice_products product
            WHERE product.product_invoice_id = NEW.id;
        
        ELSIF NEW.type = 'OUTPUT' THEN
            INSERT INTO output_products (
                product_id,
                quantity,
                user_id,
                date,
                product_invoice_id,
                created_at,
                updated_at
            )
            SELECT
                product.product_id,
                product.quantity,
                product.user_id,
                product.date,
                product.product_invoice_id,
                NOW(),
                NOW()
            FROM product_invoice_products product
            WHERE product.product_invoice_id = NEW.id;
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
